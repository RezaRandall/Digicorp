<?php 
    class Nilai{
        public $mapel;
        public $nilai;

        public function __construct($mapel, $nilai){
            $this->mapel = $mapel;
            $this->nilai = $nilai;
        }
    }

    class Siswa {
        public $nrp;
        public $nama;
        public $daftarNilai = [];

        public function __construct($nrp, $nama){
            $this->nrp = $nrp;
            $this->nama = $nama;
        }

        public function tambahNilai ($mapel, $nilai)
        {
            $nilaiBaru = new Nilai($mapel, $nilai);
            if(count($this->daftarNilai) < 3){
                $this->daftarNilai[] = $nilaiBaru;
            }
        }
    }

    $siswaBaru = new Siswa("12345", "Name Siswa Baru");
    $siswaBaru->tambahNilai("Inggris", 100);

    $siswaList = [];
    for($i = 1; $i <= 10; $i++){
        $namaSiswa = generateRandomString(10);
        $mapel = ["Inggris", "Indonesia", "Jepang"][rand(0,2)];
        $nilai = rand(0, 100);

        $siswa = new Siswa("NRP$i", $namaSiswa);
        $siswa->tambahNilai($mapel, $nilai);
        $siswaList[] = $siswa;
    }

    function generateRandomString($length = 10){
        $character = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $randomString = "";
        for($i = 1; $i < $length; $i++){
            $randomString .= $character[rand(0, strlen($character) -1 )];
        }
        return $randomString;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Data Siswa</h1>
    <table border="1">
        <tr>
            <th>NRP</th>
            <th>NAMA</th>
            <th>DAFTAR NILAI</th>
        </tr>
        <?php foreach($siswaList as $siswa): ?>
        <tr>
            <td><?= $siswa->nrp?></td>
            <td><?= $siswa->nama?></td>
            <td>
                <ul>
                    <?php foreach($siswa->daftarNilai as $nilai):  ?>
                    <li><?= $nilai->mapel ?>: <?= $nilai->nilai  ?></li>
                    <?php endforeach; ?>
                </ul>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>