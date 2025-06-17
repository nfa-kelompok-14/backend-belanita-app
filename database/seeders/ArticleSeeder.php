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
            'content' => 'Upaya mengangkat derajat kesetaraan ataupun emansipasi wanita masih menjadi topik
            yang selalu didengung-dengungkan di banyak ruang-ruang publik sampai saat ini.
            Perjuangan Raden Ajeng (R.A.) Kartini mempelopori derajat kesetaraan perempuan dalam semua lini
            kehidupan masih kencang bergema khususnya di bulan April, bulan kelahiran RA Kartini.

            Akan tetapi, memperingati Hari Kartini 21 April tidak cukup sebatas menyanyikan lagu
            Ibu Kita Kartini atau memakai kebaya. Hari Kartini menjadi momen yang tepat untuk mengingatkan
            dan menagih upaya bersama dalam rangka meningkatkan pemberdayaan perempuan di negara ini.

            Pemberdayaan perempuan dalam pembangunan bangsa pun sejalan dengan Program Asta Cita
            yang ditetapkan pemerintah. Untuk mengembangkan peran perempuan Indonesia dalam aspek perekonomian
            ini tentunya dibutuhkan berbagai hal penting antara lain peningkatan akses di bidang ekonomi
            termasuk literasi dan inklusi keuangan. Peningkatan literasi dan inklusi keuangan bagi perempuan
            tidak hanya memampukan perempuan merencanakan keuangan dengan baik, tetapi juga sebagai tameng diri
            dari maraknya kejahatan di sektor jasa keuangan. Kemajuan teknologi informasi pun digunakan untuk meningkatkan
            literasi keuangan masyarakat serta memperluas daerah yang dapat dijangkau.

            Platform digital Sikapi Uangmu, yang berfungsi sebagai saluran komunikasi khusus untuk konten
            edukasi keuangan kepada masyarakat melalui minisite dan aplikasi, telah menerbitkan 51 konten edukasi,
            dengan total 216.632 viewers. Kecakapan digital juga menjadi salah satu penentu keberhasilan dari
            pemberdayaan perempuan untuk meningkatkan kesejahteraan keluarga. Perempuan yang cakap digital akan
            mampu memaksimalkan setiap kesempatan yang ada.

            Source: https://finance.detik.com/moneter/d-7889745/perempuan-cerdas-keuangan-menuju-kesetaraan-finansial',
            'status' => 'published',
            'user_id' => 1
        ]);

        Article::create([
            'title' => 'Kasus Kekerasan terhadap Perempuan di Indonesia Naik Hampir 10% pada 2024',
            'slug' => Str::slug('Kasus Kekerasan terhadap Perempuan di Indonesia Naik Hampir 10% pada 2024'),
            'image' => 'article/article-2.jpg',
            'content' => 'Komnas Perempuan melaporkan bahwa jumlah kasus kekerasan terhadap perempuan
            yang dilaporkan pada 2024 mencapai 445.502 kasus, meningkat hampir 10% dibandingkan tahun sebelumnya.

            Peningkatan terbesar terjadi pada kekerasan berbasis gender di ranah personal.
            Kasus kekerasan terhadap perempuan juga mengalami penurunan, dari 900 kasus di 2023 menjadi
            800 kasus di 2024. Kepala DP3AP2KB, Retno Sudewi, mengungkapkan bahwa dari total kasus yang
            terdeteksi, hanya sekitar 20-30 persen yang berhasil diproses secara hukum.

            Retno menambahkan, berbagai upaya telah dilakukan oleh Pemprov Jateng bersama sejumlah
            pemangku kepentingan, termasuk organisasi-organisasi perempuan seperti TP PKK, Muslimat,
            Fatayat, serta akademisi. "Kita bersinergi dan berkolaborasi dengan beberapa mitra.
            Yang terpenting adalah upaya-upaya pencegahan," katanya. Sementara itu, Sekretaris Daerah Provinsi
            Jateng, Sumarno, menyoroti tantangan dalam mengidentifikasi kasus kekerasan terhadap perempuan
            dan anak, karena banyak korban yang enggan melapor.

            "Pasalnya, korban masih mendapat stigma negatif dan kekerasan masih dianggap tabu oleh masyarakat.
            Apalagi, pelakunya seringkali adalah orang-orang terdekat korban," jelasnya.
            Sumarno menekankan pentingnya layanan yang hati-hati bagi korban yang berani melapor.

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
            masih menjadi masalah serius di ibu kota. Kepala Dinas PPAPP DKI Jakarta Mochamad Miftahulloh Tamary menyebut,
            data tersebut tercatat sejak Januari hingga 26 Februari 2025.

            "Pada Januari hingga 26 Februari 2025, ada sebanyak 356 korban. Kami berupaya berkolaborasi untuk
            memperkuat perspektif penegak hukum dalam menangani kasus perempuan dan anak, termasuk disabilitas.
            Menerapkan pasal yang tepat dalam proses penegakan hukum, menerapkan alat bukti yang khusus dalam
            kasus perempuan dan anak, khususnya kekerasan seksual," kata Miftah dalam keterangannya, Jumat (28/2/2025).

            Di sisi lain, untuk menimbulkan efek jera bagi pelaku, Miftah menjelaskan Dinas PPAPP bersama
            aparat penegak hukum menindaklanjuti kasus dengan maksimal seluruh laporan kepolisian terkait
            kekerasan terhadap perempuan dan anak. Jika pelaku adalah anak, Miftah mengatakan maka perlu
            dilakukan restorative justice dan diversi. Namun, jika pelaku merupakan orang dewasa, maka proses
            kepolisian harus dijalankan hingga pelimpahan berkas ke kejaksaan.

            Selain itu, pihaknya akan terus mengampanyekan pencegahan kekerasan terhadap perempuan dan anak,
            dengan sasaran masyarakat dan melibatkan berbagai pihak seperti anak, orangtua, sekolah, lembaga masyarakat, perwakilan pemuda
            dari berbagai Satuan Kerja Perangkat Daerah (SKPD), seperti Abang None, Duta Pora.

            Source: https://news.detik.com/berita/d-7799359/pemprov-jakarta-356-anak-perempuan-jadi-korban-kekerasan-sejak-awal-2025',
            'status' => 'published',
            'user_id' => 4
        ]);

        Article::create([
            'title' => 'OJK Sebut Perempuan Sering Jadi Korban Scam Keuangan',
            'slug' => Str::slug('OJK Sebut Perempuan Sering Jadi Korban Scam Keuangan'),
            'image' => 'article/article-4.jpg',
            'content' => 'Otoritas Jasa Keuangan (OJK) mengungkap, perempuan mendominasi jumlah korban penipuan keuangan.
            Berdasarkan data Survei Nasional Literasi dan Inklusi Keuangan (SNLIK) OJK 2023, sebanyak 66,75% tingkat
            literasi keuangan perempuan. Sementara tingkat inklusi sebesar 76,08%.Kepala Eksekutif Pengawas Perilaku

            Pelaku Usaha Jasa Keuangan, Edukasi dan Pelindungan Konsumen OJK Friderica Widyasari Dewi mengungkap,
            ada beberapa modus penipuan yang kerap menyasar perempuan. Pertama, melalui pesan singkat di sosial media.
            Biasanya, para pelaku menggunakan bahasa yang tidak biasa digunakan. Perempuan yang akrab disapa Kiki ini
            mengatakan, pelaku penipuan menggunakan AI untuk mengirim pesan kebanyakan korbannya.

            Modus kedua, Kiki menyebut para penipu biasanya berdalih relationship atau hubungan pacaran.
            Ia menyebut, banyak perempuan yang diajak bertemu kemudian diminta untuk melakukan transfer
            sejumlah uang. Berdasarkan survei sebelumnya, Kiki menyebut banyak perempuan yang terjebak dalam
            putaran pinjaman online (pinjol) ilegal. Ia menyebut, mudahnya perempuan menjadi korban lantaran
            digunakan untuk kebutuhan konsumtif. Namun begitu, Kiki menegaskan, OJK sendiri memiliki fokus yang
            besar terhadap perlindungan konsumen perempuan. Untuk keuangan syariah OJK menghadirkan
            Sahabat Ibu Cakap Keuangan Syariah (SICANTIK) dan Ibu Anak Cakap Keuangan (BUNDAKU).

            Source: https://finance.detik.com/berita-ekonomi-bisnis/d-7878405/ojk-sebut-perempuan-sering-jadi-korban-scam-keuangan',
            'status' => 'draft',
            'user_id' => 1
        ]);

        Article::create([
            'title' => 'Anggaran KemenPPPA Dipangkas Hampir 50% di Tengah Upaya Pemberdayaan Perempuan',
            'slug' => Str::slug('Anggaran KemenPPPA Dipangkas Hampir 50% di Tengah Upaya Pemberdayaan Perempuan'),
            'image' => 'article/article-5.jpg',
            'content' => 'Efisiensi anggaran 2025 tidak mengecualikan Kementerian Pemberdayaan Perempuan dan
            Perlindungan Anak (KemenPPPA), sementara upaya pemberdayaan perempuan dan perlindungan anak di
            Indonesia masih dicegat sejumlah tantangan. Anggaran kementerian tersebut berkurang Rp146.886.424.000,
            atau 48,86 persen, dari Rp300.654.181.000 jadi Rp153.767.757.000.

            Staf Ahli Menteri PPPA Bidang Hubungan Kelembagaan, Indra Gunawan, mengatakan bahwa pihaknya menyiasati kondisi tersebut dengan
            giat membangun kolaborasi di berbagai bidang. Kolaborasi ini dilakukan termasuk dengan
            kementerian/lembaga teknis yang anggarannya masih lebih banyak dari KemenPPPA. "Walau sama-sama dipotong,
            tapi kalau (anggaran awalnya) Rp10 triliun, dipotong 50 persen jadi (Rp)5 triliun, itu masih bisa
            dimanfaatkan untuk berkolaborasi," katanya saat jumpa pers seputar Hari Perempuan Sedunia di Kantor
            PBB di Indonesia, Jakarta, Kamis, 6 Maret 2025.

            Tidak hanya dengan kementerian/lembaga, KemenPPPA juga mengaku semakin gencar menggandeng pihak-pihak lain.
            Indra berkata, "Kolaborasi-kolaborasi ini sebenarnya sudah kami lakukan sebelumnya, tapi saat ini jadi semakin gencar karena efisiensi."
            Di tengah keterbatasan anggaran, Indra menyebut, KemenPPPA akan tetap menangani sejumlah kasus
            seputar perempuan dan anak di Indonesia. Layanan ini, kata dia, merupakan bagian dari alokasi dana
            khusus yang tetap berjalan, kendati pembiayaan secara keseluruhan terpotong efisiensi anggaran.

            Source: https://www.liputan6.com/lifestyle/read/5949293/hari-perempuan-sedunia-2025-bagaimana-nasib-pemberdayaan-perempuan-dan-perlindungan-anak-indonesia-di-tengah-efisiensi-anggaran',
            'status' => 'published',
            'user_id' => 1
        ]);

        Article::create([
            'title' => '12 Kantor Polisi di Nagpur Laporkan Nol Penangkapan Perempuan dalam Dua Bulan',
            'slug' => Str::slug('12 Kantor Polisi di Nagpur Laporkan Nol Penangkapan Perempuan dalam Dua Bulan'),
            'image' => 'article/article-6.jpg',
            'content' => 'Data dari polisi Maharashtra mengungkap bahwa dari 33 kantor polisi di Nagpur,
            sebanyak 12 di antaranya tidak mencatat satu pun penangkapan perempuan selama dua bulan tersebut.

            Total penangkapan kota: 892 pria, tetapi hanya 40 perempuan yang ditangkap—menunjukkan ketimpangan
            gender yang signifikan. Kantor polisi tanpa penangkapan perempuan, antara lain: Bajaj Nagar,
            Beltarodi, Hingna, MIDC, Pachpaoli, Pardi, Rana Pratap Nagar, Sakkardara, Shanti Nagar, Tehsil,
            Wadi, dan Wathoda. Beberapa kantor bahkan mencatat jumlah penangkapan pria yang tinggi: Tehsil (50),
            MIDC (42), Yashodhara Nagar (43), Pardi (33), Pachpaoli (34), dan Rana Pratap Nagar (32)—semua
            tanpa satu perempuan pun.

            Secara keseluruhan, lebih dari sepertiga kantor polisi tidak menangkap satu pun perempuan dalam
            periode dua bulan, yang bisa diartikan sebagai: Tingkat keterlibatan perempuan
            dalam kejahatan yang benar-benar rendah, atau adanya perbedaan dalam cara laporan dibuat,
            pendaftaran dilakukan, atau penegakan hukum terhadap perempuan.

            Source: https://timesofindia.indiatimes.com/city/nagpur/12-city-police-stations-report-zero-female-arrests-in-two-months/articleshow/121523537.cms',
            'status' => 'published',
            'user_id' => 1
        ]);

        Article::create([
            'title' => 'Hari Perempuan Sedunia dan PR Mengatasi Kekerasan Berlapis dalam Pemilu',
            'slug' => Str::slug('Hari Perempuan Sedunia dan PR Mengatasi Kekerasan Berlapis dalam Pemilu'),
            'image' => 'article/article-7.jpg',
            'content' => ' Perempuan yang menjadi calon legislatif di Pemilu 2024 menghadapi berbagai bentuk
            kekerasan: ekonomi, verbal, seksual, digital, struktural, dan hukum. Istilah “kekerasan hukum” digunakan
            untuk mendeskripsikan kebijakan KPU (PKPU No.10/2023) yang menghitung kuota calon perempuan dengan
            membulatkan hasil jadi ke bawah, bertentangan dengan undang-undang dan telah diterapkan sebelumnya.
            Meskipun gugatan di MA berhasil, KPU tidak merevisi aturan tersebut.

            Akibatnya, ada 207 caleg perempuan yang tidak memenuhi ambang kuota minimal 30%. Sebanyak 82% caleg perempuan menyatakan kekerasan semakin
            intens dibanding pemilu sebelumnya. Pelaporan pengaduan dianggap sepele. Contoh nyata: caleg perempuan
            kerap diganggu secara fisik (ditarik tangan/pundak paksa), diintimidasi saat rapat hingga malam di
            hotel, dan menerima ancaman digital seperti meme “jangan pilih perempuan sok moralis”.

            Ancaman verbal termasuk peringatan agar berhenti bicara, dan ancaman tak dikenal saat berkunjung
            ke konstituen. Sebanyak 86% responden mengaku kekerasan ini berdampak langsung ke efektivitas
            kinerja politik mereka. Akibatnya, banyak caleg memilih mundur, menyensor diri, atau ragu untuk
            berpartisipasi aktif dalam politik.

            Source: https://www.kompas.id/artikel/hari-perempuan-sedunia-dan-pr-mengatasi-kekerasan-berlapis-di-pemilu',
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
            membentuk masa depan bangsa yang lebih inklusif dan setara. Dalam sambutannya, Putri Kus Wisnu Wardani menyampaikan,

            “Yayasan Puteri Indonesia, sejak awal berdiri, memiliki misi yang kuat untuk menciptakan perempuan
            yang tidak hanya cerdas dan berprestasi, tetapi juga peka terhadap lingkungan sosialnya.
            Ia menekankan pentingnya kolaborasi antarsektor untuk menciptakan ruang yang lebih luas bagi
            perempuan agar bisa berkembang, memimpin, dan terlibat dalam pengambilan keputusan strategis.

            Dalam kesempatan yang sama, Direktur PT Mustika Ratu Tbk, Kusuma Ida Anjani, menegaskan bahwa
            inisiatif ini merupakan bagian dari komitmen jangka panjang perusahaan untuk memajukan perempuan Indonesia.

            Source: https://mediaindonesia.com/humaniora/758742/women-empowerment-conferencewec-2025-digelar-untuk-perempuan-indonesia',
            'status' => 'published',
            'user_id' => 1
        ]);

        Article::create([
            'title' => 'Menteri PPPA: 1 dari 4 Perempuan Alami Kekerasan Sepanjang Hidupnya',
            'slug' => Str::slug('Menteri PPPA: 1 dari 4 Perempuan Alami Kekerasan Sepanjang Hidupnya'),
            'image' => 'article/article-9.jpg',
            'content' => 'Data SIMFONI PPA terbaru menunjukkan 25% perempuan di Indonesia mengalami kekerasan
            (fisik/psikis) sepanjang hidup, serta 9% anak menjadi korban. Ia menekankan bahwa perlindungan
            terhadap perempuan dan anak bukan hanya kewajiban moral, tetapi juga mandat konstitusi untuk
            menjunjung tinggi hak asasi manusia (HAM) dan keadilan sosial.

            Menurut Arifah, kekerasan terhadap perempuan dan anak merupakan isu multidimensi yang memerlukan pendekatan komprehensif dari
            pencegahan, perlindungan, hingga pemulihan korban. Oleh karena itu, kerja sama antar-lembaga dan
            lintas sektor sangat krusial.

            Arifah menyebut kehadiran paralegal sangat penting dalam mendampingi
            korban, terutama saat berada dalam kondisi paling rentan. Paralegal menjadi jembatan antara korban
            dan sistem hukum, membantu menyiapkan dokumen dan membuka akses keadilan.

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

            The Women’s Media Start-up Programme, which IMS and Suara initiated in 2023,  has been instrumental
            in empowering women’s media. The programme offers support with collaborative content production,
            business management, audience engagement, building revenue models and networking. The programme
            initially had six women’s media outlets as participants: Bincang Perempuan, DigitalMama, Kutub.id,
            Magdalene, Dewiku, and KatongNTT. In the two years since then, not only has the programme grown –
            with Simbur Cahaya, Femini.id and Tentang Puan now participating in it – but the organisations too
            have grown remarkably: by collaborating on producing content, reportage, campaigns and hosting events,
            they have increased their reach, website traffic, revenue, and importantly, the positive impact they
            have on their local communities. From being small media outlets with minimal staff, they are now
            influential voices in the media landscape with a strong social media presence.

            Source: https://www.mediasupport.org/blogpost/breaking-barriers-together-the-growth-of-womens-media-in-indonesia/',
            'status' => 'published',
            'user_id' => 1
        ]);
    }
}
