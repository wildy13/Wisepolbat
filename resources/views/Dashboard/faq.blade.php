@extends('Dashboard.Layouts.main')

@section('konten')
    <div class="card faq">
        <div class="card-header">
            Pertanyaan Yang Sering Diajukan
        </div>
        <div class="container">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h2 class="pertanyaan"><i class="fas fa-caret-right caretPertanyaan"></i>Apa Itu KPK ?</h2>
                    <div class="container jawaban">
                        <p class="jawaban">Komisi Pemberantasan Korupsi.</p>
                    </div>
                </li>
                <li class="list-group-item">
                    <h2 class="pertanyaan"><i class="fas fa-caret-right caretPertanyaan"></i>Apa Itu Whistleblower ?</h2>
                    <div class="container jawaban">
                        <p class="jawaban">Seseorang yang melaporkan perbuatan yang berindikasi tindak pidana korupsi yang terjadi di dalam organisasi tempat dia bekerja, dan dia memiliki akses informasi yang memadai atas terjadinya indikasi tindak pidana korupsi tersebut.</p>
                    </div>
                </li>
                <li class="list-group-item">
                    <h2 class="pertanyaan"><i class="fas fa-caret-right caretPertanyaan"></i>Apakah kami menjaga kerahasiaan data anda ?</h2>
                    <div class="container jawaban">
                        <p class="jawaban">Sistem ini secara teknis menjaga anonimitas Anda. Agar lebih menjamin Kerahasiaan, perhatikan hal-hal yang berikut ini :</p>
                        <ul class="jawaban">
                            <li>Tidak mengisi data pribadi atau informasi yang memungkinkan bagi orang lain untuk melakukan pelacakan siapa Anda, seperti nama Anda atau hubungan Anda dengan pelaku-pelaku.</li>
                            <li>Hindari penggunaan Komputer kantor Anda jika Pengaduan yang akan Anda berikan melibatkan pihak-pihak di dalam kantor Anda.</li>
                        </ul>
                        <p class="jawaban">KPK akan merahasiakan informasi pribadi Anda sebagai whistleblower, KPK hanya fokus pada kasus yang dilaporkan.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection