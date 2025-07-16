@extends('layouts.index-menu')

@push('style')
    {{-- You can add specific styles for this page here if needed --}}
@endpush

@section('title', 'Ecozyne | Semua Artikel')

@section('content')
    <div class="page-title mt-5">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Artikel</h1>
                        <p class="mb-0">
                            Kumpulan artikel informatif seputar Eco Enzim. Dapatkan wawasan, tips, dan pengetahuan terbaru
                            yang kami
                            sajikan secara akurat dan mudah dipahami.
                        </p>
                    </div>
                    {{-- Search Widget for Articles --}}
                    <div class="search-widget widget-item mt-6">
                        <form id="searchArticleForm"> {{-- Added ID to the form --}}
                            <input type="text" id="searchArticleInput" placeholder="Cari artikel..."> {{-- Added ID to the
                            input --}}
                            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="current">Artikel</li>
                </ol>
            </div>
        </nav>
    </div>
    <section id="recent-posts" class="recent-posts section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Artikel</h2>
            <p>Semua Artikel</p>
        </div>

        <div class="container">
            <div class="row gy-5" id="articleCatalog"> {{-- Added ID to the container --}}
                @forelse ($allartikel as $artikel)
                    <div class="col-xl-4 col-md-6 article-item" data-title="{{ strtolower($artikel->judul) }}"
                        data-content="{{ strtolower(strip_tags($artikel->isi)) }}"> {{-- Added class and data attributes for
                        search --}}
                        <div class="post-item position-relative h-100">
                            <div class="post-img position-relative overflow-hidden">
                                <img src="{{ asset('storage/artikel/' . $artikel->foto) }}" class="img-fluid"
                                    alt="{{ $artikel->judul }}"
                                    style="width: 100%; height: 250px; object-fit: cover; object-position: center; border-radius: 8px;">
                                <span
                                    class="post-date">{{ \Carbon\Carbon::parse($artikel->created_at)->format('d M Y : H.i') }}</span>
                            </div>

                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ Str::limit($artikel->judul, 100) }}</h3>

                                {{-- Isi ringkasan artikel --}}
                                <p>{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>

                                <div class="meta d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person"></i> <span class="ps-2">Admin</span>
                                    </div>
                                </div>

                                <hr>
                                <a href="{{ route('artikelpublic.show', $artikel->id_artikel) }}"
                                    class="readmore stretched-link">
                                    <span>Selengkapnya</span><i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Pesan ini akan muncul jika tidak ada artikel sama sekali --}}
                    <div class="col-12 text-center" id="noArticlesFound" style="display: block;"> {{-- Added ID and default
                        display --}}
                        <p class="lead">Belum ada artikel yang dipublikasikan.</p>
                        <img src="{{ asset('assets/img/no-data.svg') }}" alt="Tidak ada data"
                            style="width: 300px; opacity: 0.7;">
                    </div>
                @endforelse
                {{-- This message will appear if no articles match the search --}}
                <div class="col-12 text-center" id="noSearchResults" style="display: none;">
                    <p class="lead">Tidak ada artikel yang cocok dengan pencarian Anda.</p>
                    <img src="{{ asset('assets/img/no-data.svg') }}" alt="Tidak ada data"
                        style="width: 300px; opacity: 0.7;">
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchArticleInput = document.getElementById('searchArticleInput');
            const searchArticleForm = document.getElementById('searchArticleForm');
            const articleItems = document.querySelectorAll('.article-item');
            const noArticlesFound = document.getElementById('noArticlesFound');
            const noSearchResults = document.getElementById('noSearchResults');

            function performArticleSearch() {
                const searchTerm = searchArticleInput.value.toLowerCase().trim();
                let articlesFoundCount = 0;

                articleItems.forEach(item => {
                    const articleTitle = item.dataset.title;
                    const articleContent = item.dataset.content;

                    if (articleTitle.includes(searchTerm) || articleContent.includes(searchTerm)) {
                        item.style.display = 'block'; // Show the article
                        articlesFoundCount++;
                    } else {
                        item.style.display = 'none'; // Hide the article
                    }
                });

                // Handle "no results" message
                if (searchTerm !== '') { // If there's a search term
                    if (articlesFoundCount === 0) {
                        noSearchResults.style.display = 'block';
                    } else {
                        noSearchResults.style.display = 'none';
                    }
                    noArticlesFound.style.display = 'none'; // Hide the "no articles at all" message
                } else { // If the search term is empty, show original "no articles" message if applicable
                    noSearchResults.style.display = 'none';
                    if (articleItems.length === 0) {
                        noArticlesFound.style.display = 'block';
                    } else {
                        noArticlesFound.style.display = 'none'; // Hide it if there are articles
                    }
                }
            }

            // Add event listener for input changes (live search)
            searchArticleInput.addEventListener('keyup', performArticleSearch);

            // Prevent form submission on search form
            searchArticleForm.addEventListener('submit', function (event) {
                event.preventDefault(); // Stop the default form submission
                performArticleSearch(); // Perform search on submit as well (e.g., if user presses Enter)
            });

            // Initial check for no articles if the page loads with no articles
            if (articleItems.length === 0 && noArticlesFound) {
                noArticlesFound.style.display = 'block';
            } else if (noArticlesFound) {
                noArticlesFound.style.display = 'none'; // Hide if there are articles
            }
        });
    </script>
@endpush