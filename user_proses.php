<?php
include 'config/database.php';
if(!empty($_GET['proses']))
{
    $proses = $_GET['proses'];

    #==mulai proses
    if($proses == 'tambah')
    {
        $nama       = trim(mysqli_real_escape_string($con, $_POST['nama']));
        $username   = trim(mysqli_real_escape_string($con, $_POST['username']));
        $password_1 = trim(mysqli_real_escape_string($con, $_POST['password_1']));
        $password_2 = trim(mysqli_real_escape_string($con, $_POST['password_2']));


        if($password_1 != $password_2)
        {
            $_SESSION['alert'] = [
                'status'    => 'danger',
                'pesan'     => 'Gagal, password yang dimasukkan tidak sama'
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }


        $sql        = "SELECT * FROM tb_user WHERE username='".$username."' ";
        $sql_data   = mysqli_query($con, $sql) or die (mysqli_error($con));
        
        if(mysqli_num_rows($sql_data) == 0)
        {
            $sql = "INSERT INTO tb_user SET 
                    nama = '".$nama."',
                    username = '".$username."',
                    password = '".sha1(sha1($password_1))."' ";

            mysqli_query($con, $sql) or die (mysqli_error($con));

            $_SESSION['alert'] = [
                'status'    => 'success',
                'pesan'     => 'Selamat, tambah data berhasil'
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else{
            
            $_SESSION['alert'] = [
                'status'    => 'danger',
                'pesan'     => 'Gagal, gunakan username lain'
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }









    #==mulai proses
    else if($proses == 'edit')
    {
        $id         = trim(mysqli_real_escape_string($con, $_POST['id']));
        $nama       = trim(mysqli_real_escape_string($con, $_POST['nama']));
        $username   = trim(mysqli_real_escape_string($con, $_POST['username']));

        $sql        = "SELECT * FROM tb_user WHERE username='".$username."' AND id != '".$id."' ";
        $sql_data   = mysqli_query($con, $sql) or die (mysqli_error($con));
        
        if(mysqli_num_rows($sql_data) == 0)
        {
            $sql = "UPDATE tb_user SET 
                    nama = '".$nama."',
                    username = '".$username."'
                    WHERE id = '".$id."' ";

            mysqli_query($con, $sql) or die (mysqli_error($con));

            $_SESSION['alert'] = [
                'status'    => 'success',
                'pesan'     => 'Selamat, edit data berhasil'
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else{
            
            $_SESSION['alert'] = [
                'status'    => 'danger',
                'pesan'     => 'Gagal, gunakan username lain'
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }










    #==mulai proses
    else if($proses == 'hapus')
    {
        $id = base64_decode($_GET['id']);

        if($id == $_SESSION['login_app']['id'])
        {
            $_SESSION['alert'] = [
                'status'    => 'danger',
                'pesan'     => 'Gagal, anda tidak dapat menghapus akun anda sendiri'
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }

        
        $sql        = "DELETE FROM tb_user WHERE id = '".$id."' ";
        $sql_data   = mysqli_query($con, $sql) or die (mysqli_error($con));
        
        $_SESSION['alert'] = [
            'status'    => 'success',
            'pesan'     => 'Selamat, hapus data berhasil'
        ];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }










    #== jika tidak ada proses yang sesuai ==#
    else{

        $_SESSION['alert'] = [
            'status'    => 'danger',
            'pesan'     => 'Tidak terdapat aksi yang diproses'
        ];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
else{

    $_SESSION['alert'] = [
        'status'    => 'danger',
        'pesan'     => 'Tidak terdapat aksi yang diproses'
    ];
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}