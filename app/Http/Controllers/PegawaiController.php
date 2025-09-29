<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    public function index()
    {
        // Data dasar
        $name   = "Farel Abdul Halim";
        $birth  = Carbon::create(2006, 2, 28);
        $today  = Carbon::now();

        // Hitung umur (1 angka di belakang koma)
        $my_age = round($birth->diffInDays($today) / 365, 1);

        // Hobi minimal 5 item
        $hobbies = ["Coding", "Gaming", "Membaca", "Olahraga", "Traveling"];

        // Tanggal harus wisuda
        $tgl_harus_wisuda = Carbon::create(2028, 10, 1);

        // Hitung sisa hari menuju wisuda (dibulatkan ke integer)
        $time_to_study_left = intval($today->diffInDays($tgl_harus_wisuda));

        // Semester saat ini
        $current_semester = 3;

        // Pesan kondisi semester
        if ($current_semester < 3) {
            $semester_message = "Masih Awal, Kejar TAK";
        } else {
            $semester_message = "Jangan main-main, kurang-kurangi main game!";
        }

        // Cita-cita
        $future_goal = "System Analyst";

        // Kirim data ke view
        $data['name']              = $name;
        $data['my_age']            = $my_age;
        $data['hobbies']           = $hobbies;
        $data['tgl_harus_wisuda']  = $tgl_harus_wisuda->toDateString();
        $data['time_to_study_left']= $time_to_study_left . " hari";
        $data['current_semester']  = $current_semester;
        $data['semester_message']  = $semester_message;
        $data['future_goal']       = $future_goal;

        return view('home', $data);
    }
}
