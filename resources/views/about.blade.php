@extends('layouts.main')

@section('title', 'Tentang Kami')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gray-800 py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="w-full md:w-1/2">
                    <h1 class="text-4xl md:text-5xl font-bold text-amber-500 mb-4">Tentang BookStore</h1>
                    <p class="text-xl text-gray-300 mb-6">Sumber terpercaya untuk buku sejak 2024. Kami bersemangat menghubungkan pembaca dengan buku favorit mereka berikutnya.</p>
                </div>
                <div class="w-full md:w-1/2">
                    <img src="{{ asset('images/about-hero.jpg') }}" alt="Tentang BookStore" class="rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </div>

    <!-- Our Story Section -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-amber-500 mb-8">Cerita Kami</h2>
            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-2/3">
                    <div class="text-gray-300 space-y-4">
                        <p>BookStore dimulai dengan ide sederhana: membuat buku berkualitas dapat diakses oleh semua orang. Yang dimulai sebagai toko kecil telah berkembang menjadi toko buku online yang komprehensif, melayani ribuan pembaca yang puas.</p>
                        <p>Misi kami adalah menginspirasi, mendidik, dan menghibur melalui kekuatan membaca. Kami percaya bahwa buku memiliki kemampuan untuk mengubah kehidupan, memicu imajinasi, dan menumbuhkan pemahaman antar sesama.</p>
                    </div>
                </div>
                <div class="w-full md:w-1/3">
                    <div class="bg-gradient-to-r from-amber-600 to-amber-500 rounded-lg shadow-lg p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Fakta Singkat</h4>
                        <ul class="space-y-3 text-gray-900">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Lebih dari 10.000 judul buku
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Layanan pelanggan 24/7
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Pengiriman cepat ke seluruh dunia
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Harga bersaing
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section class="py-16 bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-amber-500 mb-12">Nilai-Nilai Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-700 rounded-lg p-8 shadow-lg transform transition-transform hover:scale-105">
                    <div class="text-center">
                        <div class="bg-amber-500 p-4 rounded-full inline-flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-900" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-amber-500 mb-3">Seleksi Berkualitas</h3>
                        <p class="text-gray-300">Kami dengan hati-hati mengkurasi koleksi kami untuk membawa buku terbaik dari semua genre kepada Anda.</p>
                    </div>
                </div>
                <div class="bg-gray-700 rounded-lg p-8 shadow-lg transform transition-transform hover:scale-105">
                    <div class="text-center">
                        <div class="bg-amber-500 p-4 rounded-full inline-flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-900" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-amber-500 mb-3">Pelanggan Utama</h3>
                        <p class="text-gray-300">Kepuasan Anda adalah prioritas utama kami. Kami siap membantu Anda menemukan bacaan yang sempurna.</p>
                    </div>
                </div>
                <div class="bg-gray-700 rounded-lg p-8 shadow-lg transform transition-transform hover:scale-105">
                    <div class="text-center">
                        <div class="bg-amber-500 p-4 rounded-full inline-flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-900" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-amber-500 mb-3">Fokus Komunitas</h3>
                        <p class="text-gray-300">Kami percaya dalam membangun komunitas pembaca dan mendukung pendidikan literasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="bg-gradient-to-r from-amber-600 to-amber-500 rounded-xl p-10 shadow-2xl text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Ingin Tahu Lebih Banyak?</h2>
                <p class="text-xl text-gray-900 mb-6 max-w-3xl mx-auto">Kami senang mendengar dari Anda dan menjawab pertanyaan apa pun yang mungkin Anda miliki tentang toko buku kami.</p>
                <a href="{{ route('contact') }}" class="inline-block bg-gray-900 hover:bg-gray-800 text-amber-500 font-bold py-3 px-8 rounded-lg shadow-lg transition-colors">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection 