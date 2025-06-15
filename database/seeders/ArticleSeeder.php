<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'title' => 'Perempuan Cerdas Keuangan, Menuju Kesetaraan Finansial',
            'slug' => Str::slug('Perempuan Cerdas Keuangan, Menuju Kesetaraan Finansial'),
            'image' => 'article/article-1.jpg',
            'content' => 'Upaya mengangkat derajat kesetaraan ataupun emansipasi wanita masih menjadi
            topik yang selalu didengung-dengungkan di banyak ruang-ruang publik sampai saat ini.',
            'status' => 'draft',
            'user_id' => 1
        ]);

        Article::create([
            'title' => 'Kasus Kekerasan terhadap Perempuan di Indonesia Naik Hampir 10% pada 2024',
            'slug' => Str::slug('Kasus Kekerasan terhadap Perempuan di Indonesia Naik Hampir 10% pada 2024'),
            'image' => 'article/article-2.jpg',
            'content' => 'Komnas Perempuan melaporkan bahwa jumlah kasus kekerasan terhadap perempuan
            yang dilaporkan pada 2024 mencapai 445.502 kasus, meningkat hampir 10% dibandingkan tahun sebelumnya.
            Peningkatan terbesar terjadi pada kekerasan berbasis gender di ranah personal.
            Source: https://regional.kompas.com/read/2024/12/20/073640378/1900-perempuan-dan-anak-di-jateng-alami-kekerasan-sepanjang-2024',
            'status' => 'published',
            'user_id' => 4
        ]);

        Article::create([
            'title' => '356 Anak dan Perempuan di DKI Jakarta Jadi Korban Kekerasan Sejak Awal 2025',
            'slug' => Str::slug('356 Anak dan Perempuan di DKI Jakarta Jadi Korban Kekerasan Sejak Awal 2025'),
            'image' => 'article/article-3.jpg',
            'content' => 'Dinas PPAPP DKI Jakarta mencatat 356 kasus kekerasan terhadap anak dan perempuan
            sejak Januari hingga 26 Februari 2025. Angka ini menunjukkan bahwa kekerasan terhadap kelompok rentan
            masih menjadi masalah serius di ibu kota.
            Source: https://news.detik.com/berita/d-7799359/pemprov-jakarta-356-anak-perempuan-jadi-korban-kekerasan-sejak-awal-2025',
            'status' => 'published',
            'user_id' => 4
        ]);

        Article::create([
            'title' => 'OJK Sebut Perempuan Sering Jadi Korban Scam Keuangan',
            'slug' => Str::slug('OJK Sebut Perempuan Sering Jadi Korban Scam Keuangan'),
            'image' => 'article/article-4.jpg',
            'content' => 'Otoritas Jasa Keuangan (OJK) mengungkap, perempuan mendominasi jumlah korban penipuan keuangan.',
            'status' => 'draft',
            'user_id' => 1
        ]);

        Article::create([
            'title' => 'Anggaran KemenPPPA Dipangkas Hampir 50% di Tengah Upaya Pemberdayaan Perempuan',
            'slug' => Str::slug('Anggaran KemenPPPA Dipangkas Hampir 50% di Tengah Upaya Pemberdayaan Perempuan'),
            'image' => 'article/article-5.jpg',
            'content' => 'Kementerian Pemberdayaan Perempuan dan Perlindungan Anak mengalami pemotongan anggaran
            hampir 50% pada 2025. Meski demikian, kementerian berupaya tetap menangani kasus kekerasan terhadap
            perempuan dan anak melalui kolaborasi lintas sektor. Source: https://www.liputan6.com/lifestyle/read/5949293/hari-perempuan-sedunia-2025-bagaimana-nasib-pemberdayaan-perempuan-dan-perlindungan-anak-indonesia-di-tengah-efisiensi-anggaran',
            'status' => 'published',
            'user_id' => 1
        ]);

        Article::create([
            'title' => '12 Kantor Polisi di Nagpur Laporkan Nol Penangkapan Perempuan dalam Dua Bulan',
            'slug' => Str::slug('12 Kantor Polisi di Nagpur Laporkan Nol Penangkapan Perempuan dalam Dua Bulan'),
            'image' => 'article/article-6.jpg',
            'content' => 'Antara 1 Maret hingga 30 April 2025, 12 dari 33 kantor polisi di Nagpur, India,
            melaporkan tidak ada penangkapan perempuan. Data ini menimbulkan pertanyaan tentang partisipasi perempuan
            dalam kejahatan atau kemungkinan kurangnya pelaporan. Source: https://timesofindia.indiatimes.com/city/nagpur/12-city-police-stations-report-zero-female-arrests-in-two-months/articleshow/121523537.cms',
            'status' => 'published',
            'user_id' => 1
        ]);

        Article::create([
            'title' => 'Hari Perempuan Sedunia dan PR Mengatasi Kekerasan Berlapis dalam Pemilu',
            'slug' => Str::slug('Hari Perempuan Sedunia dan PR Mengatasi Kekerasan Berlapis dalam Pemilu'),
            'image' => 'article/article-7.jpg',
            'content' => 'Tidak banyak yang menyadari bahwa perempuan peserta pemilu mengalami berlapis bentuk kekerasan
            dalam Pemilu 2024. Ironisnya, salah satu pelaku kekerasan adalah lembaga negara penyelenggara pemilu.
            Hari Perempuan Sedunia yang diperingati hari ini, 8 Maret 2025, mengingatkan banyak pekerjaan rumah
            harus diselesaikan. Source: https://www.kompas.id/artikel/hari-perempuan-sedunia-dan-pr-mengatasi-kekerasan-berlapis-di-pemilu',
            'status' => 'published',
            'user_id' => 1
        ]);

        Article::create([
            'title' => 'Women Empowerment Conference (WEC) 2025 Digelar untuk Perempuan Indonesia',
            'slug' => Str::slug('Women Empowerment Conference (WEC) 2025 Digelar untuk Perempuan Indonesia'),
            'image' => 'article/article-8.jpg',
            'content' => 'WOMEN Empowerment Conference (WEC) 2025 telah digelar pada 14 April 2025 di Ballroom Westin Hotel, Jakarta.
            Hal itu diumumkan PT Mustika Ratu Tbk berkolaborasi dengan Yayasan Puteri Indonesia didukung oleh Kementerian
            Pemberdayaan Perempuan dan Perlindungan Anak (PPPA).
            Konferensi ini mengusung tema Unlock Our Potential, Shaping the Future of Indonesia dengan tujuan
            memberdayakan perempuan dari berbagai latar belakang dan mendorong partisipasi aktif mereka dalam
            membentuk masa depan bangsa yang lebih inklusif dan setara.
            Source: https://mediaindonesia.com/humaniora/758742/women-empowerment-conferencewec-2025-digelar-untuk-perempuan-indonesia',
            'status' => 'published',
            'user_id' => 1
        ]);

        Article::create([
            'title' => 'Menteri PPPA: 1 dari 4 Perempuan Alami Kekerasan Sepanjang Hidupnya',
            'slug' => Str::slug('Menteri PPPA: 1 dari 4 Perempuan Alami Kekerasan Sepanjang Hidupnya'),
            'image' => 'article/article-9.jpg',
            'content' => 'Data SIMFONI PPA terbaru menunjukkan 25% perempuan di Indonesia mengalami kekerasan (fisik/psikis) sepanjang hidup, serta 9% anak menjadi korban.
            Ia menekankan bahwa perlindungan terhadap perempuan dan anak bukan hanya kewajiban moral, tetapi juga mandat konstitusi untuk menjunjung tinggi hak asasi manusia (HAM) dan keadilan sosial.
            Source: https://nasional.kompas.com/read/2025/06/14/18595271/menteri-pppa-1-dari-4-perempuan-alami-kekerasan-sepanjang-hidupnya',
            'status' => 'draft',
            'user_id' => 1
        ]);

        Article::create([
            'title' => 'Breaking barriers, together: The growth of women’s media in Indonesia',
            'slug' => Str::slug('Breaking barriers, together: The growth of women’s media in Indonesia'),
            'image' => 'article/article-10.jpg',
            'content' => 'The Women’s Media Start-up Programme, which IMS and Suara initiated in 2023,  has been instrumental in
            empowering women’s media. The programme offers support with collaborative content production,
            business management, audience engagement, building revenue models and networking.
            The programme initially had six women’s media outlets as participants: Bincang Perempuan,
            DigitalMama, Kutub.id, Magdalene, Dewiku, and KatongNTT. In the two years since then, not only has
            the programme grown – with Simbur Cahaya, Femini.id and Tentang Puan now participating in it – but
            the organisations too have grown remarkably: by collaborating on producing content, reportage,
            campaigns and hosting events, they have increased their reach, website traffic, revenue, and
            importantly, the positive impact they have on their local communities.
            Source: https://www.mediasupport.org/blogpost/breaking-barriers-together-the-growth-of-womens-media-in-indonesia/',
            'status' => 'published',
            'user_id' => 1
        ]);
    }
}