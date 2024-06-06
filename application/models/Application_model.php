<?php

class Application_model extends CI_Model
{
    private $_table = 'applications';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllApplications($limit, $offset)
    {
        // Ambil semua data dari tabel applications dengan limit dan offset
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $applications = $query->result();

        // Ambil ID dari semua aplikasi yang ditemukan
        $application_ids = array_map(function ($application) {
            return $application->id;
        }, $applications);

        if (empty($application_ids)) {
            return []; // Tidak ada aplikasi yang ditemukan
        }

        // Ambil data terkait dari tabel image_applications berdasarkan application_id
        $this->db->select('image_applications.*, image_applications.application_id as application_id');
        $this->db->from('image_applications');
        $this->db->where_in('application_id', $application_ids);
        $images_query = $this->db->get();
        $images = $images_query->result();

        // Kelompokkan gambar berdasarkan application_id
        $images_by_application_id = [];
        foreach ($images as $image) {
            $images_by_application_id[$image->application_id][] = $image;
        }

        // Gabungkan data aplikasi dengan gambar terkait
        foreach ($applications as $application) {
            $application->images = isset($images_by_application_id[$application->id]) ? $images_by_application_id[$application->id] : [];
        }

        return $applications;
    }


    public function get_total()
    {
        return $this->db->count_all($this->_table);
    }

    public function addApplication($data)
    {
        $this->db->trans_start();
        $this->db->insert($this->_table, $data);
        $app_id = $this->db->insert_id();
        $this->load->library('upload', $this->set_upload_options());
        $files = $_FILES;
        $image_app = [];
        foreach ($_FILES['image-upload']['name'] as $key => $image) {
            $_FILES['image-upload']['name'] = $files['image-upload']['name'][$key];
            $_FILES['image-upload']['type'] = $files['image-upload']['type'][$key];
            $_FILES['image-upload']['tmp_name'] = $files['image-upload']['tmp_name'][$key];
            $_FILES['image-upload']['error'] = $files['image-upload']['error'][$key];
            $_FILES['image-upload']['size'] = $files['image-upload']['size'][$key];
            $this->upload->initialize($this->set_upload_options());
            if (!$this->upload->do_upload('image-upload')) {
                $this->db->trans_rollback();
                return $this->upload->display_errors();
            } else {
                $image_data = $this->upload->data();
                $original_filename = $image_data['file_name'];
                $file_ext = $image_data['file_ext'];
                $hashed_filename = hash('sha256', $original_filename . time() . $file_ext);
                // die(var_dump($hashed_filename));
                // rename the file
                rename($image_data['full_path'], $image_data['file_path'] . $hashed_filename . $file_ext);
                $image_app = [
                    'application_id' => $app_id,
                    'filename' => $hashed_filename . $file_ext
                ];
                $this->db->insert('image_applications', $image_app);
            }
        }
        $this->db->trans_commit();
        return true;
    }

    public function editApplication($data, $id)
    {
        $this->db->trans_start();
        // echo '<pre>' . var_export(array_unique($_FILES['image-upload-edit']['error'])[0], true) . '</pre>';
        // return;
        if (array_unique($_FILES['image-upload-edit']['error'])[0] == 0) {
            // Hapus terlebih dahulu file sebelumnya
            $this->db->where('application_id', $id);
            $oldImages = $this->db->get('image_applications')->result();
            foreach($oldImages as $oldImage) {
                unlink(FCPATH . 'assets/img/apps/' . $oldImage->filename);
            }
            // echo '<pre>' . var_export($result, true) . '</pre>';
            // return;

            // hapus data semua gambar yang terkait dengan app yang sedang diedit di database
             $this->db->where('application_id', $id);
             $this->db->delete('image_applications');

           
            $this->load->library('upload', $this->set_upload_options());
            $files = $_FILES;
            $image_app = [];
            foreach ($_FILES['image-upload-edit']['name'] as $key => $image) {
                $_FILES['image-upload-edit']['name'] = $files['image-upload-edit']['name'][$key];
                $_FILES['image-upload-edit']['type'] = $files['image-upload-edit']['type'][$key];
                $_FILES['image-upload-edit']['tmp_name'] = $files['image-upload-edit']['tmp_name'][$key];
                $_FILES['image-upload-edit']['error'] = $files['image-upload-edit']['error'][$key];
                $_FILES['image-upload-edit']['size'] = $files['image-upload-edit']['size'][$key];
                $this->upload->initialize($this->set_upload_options());
                if (!$this->upload->do_upload('image-upload-edit')) {
                    $this->db->trans_rollback();
                    return $this->upload->display_errors();
                } else {
                    $image_data = $this->upload->data();
                    $original_filename = $image_data['file_name'];
                    $file_ext = $image_data['file_ext'];
                    $hashed_filename = hash('sha256', $original_filename . time() . $file_ext);
                    // die(var_dump($hashed_filename));
                    // rename the file
                    rename($image_data['full_path'], $image_data['file_path'] . $hashed_filename . $file_ext);
                    $image_app = [
                        'application_id' => $id,
                        'filename' => $hashed_filename . $file_ext
                    ];
                    $this->db->insert('image_applications', $image_app);
                }
            }
        } else {
            $this->db->where('id', $id);
            $this->db->update($this->_table, $data);
        }
       
        $this->db->trans_commit();
        return true;
    }

    public function delete_app_by_id($id)
    {
        $this->db->where('application_id', $id);
            $oldImages = $this->db->get('image_applications')->result();
            foreach($oldImages as $oldImage) {
                unlink(FCPATH . 'assets/img/apps/' . $oldImage->filename);
        }
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

    private function set_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = FCPATH . 'assets/img/apps/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 10000;
        $config['overwrite'] = FALSE;

        return $config;
    }
}
