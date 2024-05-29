<?php

use PHPUnit\Framework\TestCase;
final class CodingTest extends TestCase
{
    public function testCreateAdmin()
    {
        $admin_data = array(
            'first_name' => 'admin',
            'last_name' => 'admin',
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_BCRYPT),
            'password_confirmation' => password_hash('admin', PASSWORD_BCRYPT),
            'email' => 'john@example.com',
            'phone_number' => '123456789'
        );
        $user_model = new User_model();
        $admin_data = $user_model->register($admin_data); 
    }

}