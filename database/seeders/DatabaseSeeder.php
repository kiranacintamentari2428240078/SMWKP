<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database with 30-50 realistic, relational records.
     */
    public function run(): void
    {
        // ─── 1. CORE DEMO USERS ────────────────────────────────
        $wisatawanDemo = User::create([
            'name' => 'Wisatawan Demo',
            'email' => 'wisatawan@demo.com',
            'password' => Hash::make('password'),
            'role' => 'wisatawan',
        ]);

        $mitraDemo = User::create([
            'name' => 'Mitra Demo',
            'email' => 'mitra@demo.com',
            'password' => Hash::make('password'),
            'role' => 'mitra',
        ]);

        $dinasDemo = User::create([
            'name' => 'Admin Dinas Demo',
            'email' => 'dinas@demo.com',
            'password' => Hash::make('password'),
            'role' => 'admin_dinas',
        ]);

        // ─── 2. ADDITIONAL USER SEEDING (Tourists & Mitras) ─────
        $touristNames = [
            'Rian Wijaya', 'Budi Setiawan', 'Siti Aminah', 'Dewi Lestari', 
            'Hendra Wijaya', 'Andi Pratama', 'Lutfi Hakim', 'Rina Marlina', 
            'Aditya Nugraha', 'Mega Utami', 'Yusuf Habibie', 'Kartika Sari', 
            'Dian Sastrowardoyo', 'Giri Prasetyo', 'Indra Herlambang'
        ];

        $tourists = [$wisatawanDemo];
        foreach ($touristNames as $idx => $name) {
            $tourists[] = User::create([
                'name' => $name,
                'email' => 'tourist' . ($idx + 1) . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'wisatawan',
            ]);
        }

        $mitraNames = [
            'Siti Rahayu', 'Ahmad Syafei', 'Haji Abdul', 'Heriyanto', 
            'Yusuf Rahman', 'Fanny Halim', 'Sri Wahyuni', 'Donny Irwandi', 
            'Toni Wijaya', 'Rudi Hartono'
        ];

        $mitras = [$mitraDemo];
        foreach ($mitraNames as $idx => $name) {
            $mitras[] = User::create([
                'name' => $name,
                'email' => 'mitra' . ($idx + 2) . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'mitra',
            ]);
        }

        // ─── 3. RESTAURANTS DATA SEEDING ────────────────────────
        $restoTemplates = [
            [
                'nama_restoran' => 'Pempek Candy Jenderal Sudirman',
                'kategori' => 'Pempek',
                'alamat' => 'Jl. Jend. Sudirman No.149, Palembang',
                'latitude' => -2.983944,
                'longitude' => 104.757022,
                'description' => 'Pempek Candy menyajikan pempek berkualitas premium dengan cita rasa ikan tenggiri asli yang khas dan kuah cuko yang pedas-mantap.',
                'photos' => ['https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=500'],
                'nib_number' => '1234567890123',
                'halal_certificate_number' => 'HALAL-321100002143',
                'status' => 'approved',
            ],
            [
                'nama_restoran' => 'Tekwan Haji Abdul',
                'kategori' => 'Tekwan',
                'alamat' => 'Jl. Radial No. 12, Palembang',
                'latitude' => -2.990421,
                'longitude' => 104.750324,
                'description' => 'Tekwan legendaris dengan kuah kaldu udang segar yang melimpah, disajikan dengan bengkoang iris, jamur kuping, dan bawang goreng harum.',
                'photos' => ['https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=500'],
                'nib_number' => '9876543210123',
                'halal_certificate_number' => 'HALAL-321100004321',
                'status' => 'approved',
            ],
            [
                'nama_restoran' => 'Mie Celor 26 Ilir H. Syafei',
                'kategori' => 'Mie Celor',
                'alamat' => 'Jl. Radial No. 26 Ilir, Palembang',
                'latitude' => -2.991204,
                'longitude' => 104.752402,
                'description' => 'Pionir mie celor di Palembang. Menyajikan mie kuning tebal dengan siraman kuah kental kaldu udang galah yang gurih, telur rebus setengah matang, dan tauge segar.',
                'photos' => ['https://images.unsplash.com/photo-1612927601601-6638404737ce?w=500'],
                'nib_number' => '5432109876543',
                'halal_certificate_number' => 'HALAL-321100008899',
                'status' => 'approved',
            ],
            [
                'nama_restoran' => 'Model H. Syafei Merdeka',
                'kategori' => 'Model',
                'alamat' => 'Jl. Merdeka No. 12, Palembang',
                'latitude' => -2.986324,
                'longitude' => 104.755012,
                'description' => 'Menyajikan Model ikan dengan isi tahu sutra gurih, disiram kuah sup kaldu udang bening beraroma daun seledri, jamur kuping, dan soun kenyal.',
                'photos' => ['https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500'],
                'nib_number' => '8899001122334',
                'halal_certificate_number' => 'HALAL-321100007788',
                'status' => 'approved',
            ],
            [
                'nama_restoran' => 'Laksan 88 Plaju',
                'kategori' => 'Laksan',
                'alamat' => 'Jl. DI. Panjaitan No. 88, Plaju, Palembang',
                'latitude' => -3.003984,
                'longitude' => 104.781293,
                'description' => 'Potongan pempek lenjer gurih yang disajikan dalam balutan kuah santan oranye kental, kaya akan rempah ebi yang wangi dan lezat.',
                'photos' => ['https://images.unsplash.com/photo-1606787366850-de6330128bfc?w=500'],
                'nib_number' => '4455667788990',
                'halal_certificate_number' => null,
                'status' => 'submitted', // Needs Dinas Verification
            ],
            [
                'nama_restoran' => 'Pempek Vico Radial',
                'kategori' => 'Pempek',
                'alamat' => 'Jl. Letkol Iskandar No. 541, Radial, Palembang',
                'latitude' => -2.988024,
                'longitude' => 104.751234,
                'description' => 'Outlet premium Pempek Vico Radial dengan kapasitas meja makan keluarga yang besar dan fasilitas parkir luas.',
                'photos' => ['https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=500'],
                'nib_number' => '9120108823412',
                'halal_certificate_number' => 'SH-2023-PLM-0082',
                'status' => 'submitted', // Needs Dinas Verification
            ],
            [
                'nama_restoran' => 'Pempek Saga Sudi Mampir',
                'kategori' => 'Pempek',
                'alamat' => 'Jl. Merdeka No. 22, Palembang',
                'latitude' => -2.988771,
                'longitude' => 104.754112,
                'description' => 'Terkenal dengan pempek panggang (pempek tunu) dan pempek kulitnya yang renyah dan gurih, disajikan dengan cuko kental pedas manis.',
                'photos' => ['https://images.unsplash.com/photo-1476224203421-9ac39bcb3327?w=500'],
                'nib_number' => '7766554433221',
                'halal_certificate_number' => 'HALAL-321100009900',
                'status' => 'approved',
            ],
            [
                'nama_restoran' => 'Martabak Har Jenderal Sudirman',
                'kategori' => 'Martabak',
                'alamat' => 'Jl. Jend. Sudirman No. 120, Palembang',
                'latitude' => -2.982121,
                'longitude' => 104.758412,
                'description' => 'Martabak kentang legendaris khas India-Palembang, disajikan hangat dengan kuah kari kentang kental bertabur potongan cabai rawit.',
                'photos' => ['https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=500'],
                'nib_number' => '1122334455667',
                'halal_certificate_number' => 'HALAL-321100001111',
                'status' => 'approved',
            ],
            [
                'nama_restoran' => 'Pindang Sri Melayu',
                'kategori' => 'Pindang',
                'alamat' => 'Jl. Demang Lebar Daun No. 1, Palembang',
                'latitude' => -2.971212,
                'longitude' => 104.729121,
                'description' => 'Restoran taman dengan menu pindang patin dan pindang tulang iga sapi khas Palembang dengan kuah manis, pedas, dan asam segar.',
                'photos' => ['https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=500'],
                'nib_number' => '3344556677889',
                'halal_certificate_number' => 'HALAL-321100002222',
                'status' => 'approved',
            ],
            [
                'nama_restoran' => 'Es Kacang Merah Mamat Kebun Bunga',
                'kategori' => 'Es Kacang',
                'alamat' => 'Komplek Kebun Bunga, Sukarami, Palembang',
                'latitude' => -2.934121,
                'longitude' => 104.741293,
                'description' => 'Es kacang merah paling terkenal di Palembang. Kacang merahnya dimasak hingga sangat empuk dengan manis sirup cokelat khas buatan rumah.',
                'photos' => ['https://images.unsplash.com/photo-1497034825429-c343d7c6a68f?w=500'],
                'nib_number' => '5566778899001',
                'halal_certificate_number' => 'HALAL-321100003333',
                'status' => 'approved',
            ],
            [
                'nama_restoran' => 'Pempek Pak Raden Radial',
                'kategori' => 'Pempek',
                'alamat' => 'Jl. Letkol Iskandar No. 86, Palembang',
                'latitude' => -2.986121,
                'longitude' => 104.761293,
                'description' => 'Salah satu pionir kuliner pempek di Palembang dengan kualitas rasa adonan ikan tenggiri yang konsisten legendaris.',
                'photos' => ['https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=500'],
                'nib_number' => '7788990011223',
                'halal_certificate_number' => 'HALAL-321100004444',
                'status' => 'approved',
            ],
            [
                'nama_restoran' => 'Pempek Leni Veteran',
                'kategori' => 'Pempek',
                'alamat' => 'Jl. Veteran No. 84, Palembang',
                'latitude' => -2.977412,
                'longitude' => 104.766121,
                'description' => 'Menyajikan pempek dan aneka kue basah khas Palembang seperti Maksuba dan Lapis Kojo.',
                'photos' => ['https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=500'],
                'nib_number' => '9900112233445',
                'halal_certificate_number' => null,
                'status' => 'rejected', // Rejection testing
                'rejection_reason' => 'Berkas NIB tidak valid/tidak terbaca.',
            ]
        ];

        $restaurants = [];
        foreach ($restoTemplates as $idx => $t) {
            // Assign owner round robin from mitras array
            $owner = $mitras[$idx % count($mitras)];
            
            $restaurants[] = Restaurant::create([
                'user_id' => $owner->id,
                'nama_pemilik' => $owner->name,
                'nama_restoran' => $t['nama_restoran'],
                'email' => strtolower(str_replace(' ', '', $t['nama_restoran'])) . '@example.com',
                'whatsapp' => '628' . rand(111111111, 999999999),
                'kategori' => $t['kategori'],
                'alamat' => $t['alamat'],
                'maps_url' => 'https://www.google.com/maps/search/?api=1&query=' . $t['latitude'] . ',' . $t['longitude'],
                'latitude' => $t['latitude'],
                'longitude' => $t['longitude'],
                'description' => $t['description'],
                'photos' => $t['photos'],
                'nib_number' => $t['nib_number'],
                'halal_certificate_number' => $t['halal_certificate_number'],
                'nib_file' => $t['status'] === 'approved' ? 'certifications/nib_demo.pdf' : null,
                'halal_certificate_file' => $t['halal_certificate_number'] ? 'certifications/halal_demo.pdf' : null,
                'halal_status' => $t['halal_certificate_number'] ? 'verified' : 'none',
                'operational_hours' => json_encode([
                    'Senin-Jumat' => '08:00 - 21:00',
                    'Sabtu-Minggu' => '07:00 - 22:00'
                ]),
                'status' => $t['status'],
                'rejection_reason' => $t['rejection_reason'] ?? null,
            ]);
        }

        // ─── 4. MENU ITEMS SEEDING ────────────────────────────
        $menuTemplates = [
            'Pempek' => [
                ['name' => 'Pempek Kapal Selam Besar', 'price' => 25000, 'desc' => 'Pempek isi telur bebek utuh yang gurih.'],
                ['name' => 'Paket Pempek Kecil (Campur)', 'price' => 100000, 'desc' => 'Isi 25 pcs pempek kecil (adaan, kulit, telur kecil, lenjer).'],
                ['name' => 'Pempek Lenggang Panggang', 'price' => 20000, 'desc' => 'Adonan pempek dicampur telur bebek lalu dipanggang diatas bara api.'],
                ['name' => 'Pempek Adaan Premium', 'price' => 5000, 'desc' => 'Pempek bulat gurih bersantan dengan irisan daun bawang.']
            ],
            'Tekwan' => [
                ['name' => 'Tekwan Spesial Ikan Belida', 'price' => 30000, 'desc' => 'Tekwan dengan kuah kaldu udang gurih, jamur kuping, dan irisan bengkoang.'],
                ['name' => 'Tekwan Original Tenggiri', 'price' => 22000, 'desc' => 'Bulatan tekwan tenggiri kenyal gurih berkuah sup udang bening hangat.']
            ],
            'Mie Celor' => [
                ['name' => 'Mie Celor Porsi Jumbo', 'price' => 28000, 'desc' => 'Mie kuning disiram kuah udang kental gurih khas Palembang.'],
                ['name' => 'Mie Celor Telur Dadar', 'price' => 25000, 'desc' => 'Mie celor lezat disajikan dengan tambahan telur dadar iris.']
            ],
            'Model' => [
                ['name' => 'Model Tahu Ikan', 'price' => 22000, 'desc' => 'Model ikan tenggiri ukuran besar dengan isian tahu sutra lembut.'],
                ['name' => 'Model Gandum Gurih', 'price' => 15000, 'desc' => 'Model gandum renyah disiram kuah sop pedas manis segar.']
            ],
            'Laksan' => [
                ['name' => 'Laksan Kuah Santan Rempah', 'price' => 20000, 'desc' => 'Pempek lenjer diiris melintang disiram kuah santan kuning kaya rempah ebi.']
            ],
            'Martabak' => [
                ['name' => 'Martabak Kentang Telur Bebek', 'price' => 45000, 'desc' => 'Martabak telur bebek tebal disajikan dengan kuah kari kentang khas India.'],
                ['name' => 'Martabak Har Spesial Telur 2', 'price' => 35000, 'desc' => 'Martabak legendaris renyah isi 2 telur bebek/ayam disiram kari kentang.']
            ],
            'Pindang' => [
                ['name' => 'Pindang Patin Sungai Segar', 'price' => 45000, 'desc' => 'Pindang ikan patin sungai dengan kuah asam pedas nan nendang.'],
                ['name' => 'Pindang Tulang Iga Sapi', 'price' => 55000, 'desc' => 'Tulang iga sapi berdaging empuk berkuah rempah asam segar khas Ogan.']
            ],
            'Es Kacang' => [
                ['name' => 'Es Kacang Merah Palembang', 'price' => 15000, 'desc' => 'Kacang merah empuk berpadu es serut, susu kental manis, dan sirup cokelat.'],
                ['name' => 'Es Campur Sriwijaya', 'price' => 18000, 'desc' => 'Es campur melimpah alpukat, cincau, kelapa muda, dan nangka harum.']
            ]
        ];

        foreach ($restaurants as $resto) {
            $catKey = $resto->kategori;
            $items = $menuTemplates[$catKey] ?? $menuTemplates['Pempek'];
            
            foreach ($items as $item) {
                Menu::create([
                    'restaurant_id' => $resto->id,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'description' => $item['desc'],
                    'photo' => null, // Placeholder handled by model defaults
                    'category' => str_contains(strtolower($item['name']), 'es ') ? 'Minuman' : 'Makanan',
                ]);
            }
        }

        // ─── 5. REVIEWS SEEDING ───────────────────────────────
        $comments = [
            5 => [
                'Cita rasanya sangat otentik dan kuah cukonya kental gurih manis pedas pas sekali.',
                'Tempatnya bersih, parkir luas, dan pelayanannya sangat sigap. Paling juara pempek kapal selamnya!',
                'Makanan datang cepat walau ramai. Enak banget tekwannya kuah udangnya kerasa seger.',
                'Sangat cocok untuk makan bersama keluarga saat berlibur ke Palembang.',
                'Rasa bintang lima, harga masih terjangkau. Rempah-rempahnya pas di lidah.'
            ],
            4 => [
                'Pempeknya enak terasa ikannya, cuma cukonya kurang pedas untuk selera saya.',
                'Mie celornya enak kental gurih, tapi tempatnya agak panas kalau siang hari.',
                'Porsi pas kenyang, kuah pindangnya segar asam pedas lezat. Sedikit mahal.',
                'Pelayanan ramah sekali, hanya saja piring penyajian sedikit berminyak.',
                'Secara keseluruhan sangat puas, recommended untuk kulineran Palembang.'
            ],
            3 => [
                'Rasa standar seperti pempek di tempat lain. Harga agak kemahalan.',
                'Cuko pempeknya kurang nendang rasanya. Tekwan lumayan segar.',
                'Tempatnya sangat ramai jadi harus antre lama. Makanannya oke saja.',
                'Kuah laksannya agak terlalu encer hari ini. Semoga ke depan bisa ditingkatkan.'
            ],
            1 => [
                'Warning! Cukonya terasa agak basi, pelayanan lambat dan kasar sekali!',
                'Ada helai rambut di dalam mangkuk tekwan saya. Sangat kecewa dengan kebersihan tempat ini.',
                'Spam penawaran voucher belanja gratis. Silakan akses domain-palsu.com'
            ]
        ];

        // Seeding reviews across approved restaurants
        $approvedRestos = array_filter($restaurants, fn($r) => $r->status === 'approved');

        foreach ($approvedRestos as $resto) {
            // Each approved restaurant gets 3-4 random reviews
            $numReviews = rand(3, 5);
            for ($i = 0; $i < $numReviews; $i++) {
                $rating = [5, 5, 4, 4, 3, 1][rand(0, 5)]; // weighted random ratings
                $tourist = $tourists[rand(0, count($tourists) - 1)];
                
                $pool = $comments[$rating];
                $commentText = $pool[rand(0, count($pool) - 1)];
                
                // Status matching rating/comments
                $status = 'visible';
                if ($rating === 1 && str_contains($commentText, 'Spam')) {
                    $status = 'reported';
                }

                // Random date spread over the last 30 days
                $createdAt = Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59));

                Review::create([
                    'user_id' => $tourist->id,
                    'restaurant_id' => $resto->id,
                    'rating' => $rating,
                    'comment' => $commentText,
                    'reply_comment' => ($rating >= 4 && rand(0, 1)) ? 'Terima kasih banyak atas ulasan positif Anda! Kami tunggu kunjungan berikutnya.' : null,
                    'status' => $status,
                    'photo' => rand(0, 1) ? 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=500' : null,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }
        }

        // ─── 6. BOOKINGS SEEDING ──────────────────────────────
        $bookingStatuses = ['pending', 'confirmed', 'rejected'];
        
        foreach ($approvedRestos as $resto) {
            $numBookings = rand(3, 6);
            for ($i = 0; $i < $numBookings; $i++) {
                $tourist = $tourists[rand(0, count($tourists) - 1)];
                $status = $bookingStatuses[rand(0, 2)];
                
                // Spread booking dates between last 5 days (past) and next 10 days (future)
                $bookingTime = Carbon::now()->addDays(rand(-5, 10))->setHour(rand(10, 21))->setMinute([0, 30][rand(0, 1)]);

                Booking::create([
                    'user_id' => $tourist->id,
                    'restaurant_id' => $resto->id,
                    'guest_name' => $tourist->name,
                    'guest_whatsapp' => '628' . rand(111111111, 999999999),
                    'booking_time' => $bookingTime,
                    'number_of_guests' => [1, 2, 4, 6, 8][rand(0, 4)],
                    'status' => $status,
                    'created_at' => $bookingTime->copy()->subDays(2),
                ]);
            }
        }
    }
}
