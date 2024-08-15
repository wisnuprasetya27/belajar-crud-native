<?php
include 'config/database.php';
if(!empty($_GET['proses']))
{
    $proses = $_GET['proses'];

    #==mulai proses
    if($proses == 'login')
    {
        $username = trim(mysqli_real_escape_string($con, $_POST['username']));
        $password = sha1(sha1(trim(mysqli_real_escape_string($con, $_POST['password']))));

        $sql        = "SELECT * FROM tb_user WHERE username='$username' AND password='$password' ";
        $sql_data   = mysqli_query($con, $sql) or die (mysqli_error($con));
        
        if(mysqli_num_rows($sql_data) > 0)
        {
            $data = mysqli_fetch_array($sql_data);

            $_SESSION['login_app'] = [
                'id'    => $data['id'],
                'nama'  => $data['nama']
            ];

            $_SESSION['alert'] = [
                'status'    => 'success',
                'pesan'     => 'Selamat '.$data['nama'].', login anda berhasil'
            ];
            header('Location: '.$site_url.'?page='.base64_encode('dashboard'));
        }
        else{
            
            $_SESSION['alert'] = [
                'status'    => 'danger',
                'pesan'     => 'Username atau password anda salah'
            ];
            header('Location: login.php');
        }
    }
    else{

        $_SESSION['alert'] = [
            'status'    => 'danger',
            'pesan'     => 'Tidak terdapat aksi yang diproses'
        ];
        header('Location: login.php');
    }
}
else{

    $_SESSION['alert'] = [
        'status'    => 'danger',
        'pesan'     => 'Tidak terdapat aksi yang diproses'
    ];
    header('Location: login.php');
}