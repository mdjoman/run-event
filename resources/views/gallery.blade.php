@extends('master')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .hero {
        background: linear-gradient(135deg, #0b1c3f 0%, #152c5b 100%);
        color: #fff;
        padding: 60px 0 100px;
        position: relative;
        overflow: hidden;
    }

    .hero-content {
        max-width: 600px;
    }

    .subtitle {
        color: #7cb342;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: 2px;
        margin-bottom: 10px;
        display: block;
    }

    .hero h1 {
        font-size: 48px;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 15px;
    }

    .hero h1 span {
        color: #7cb342;
    }

    .hero p {
        font-size: 15px;
        color: #ddd;
    }

    .hero-quote {
        position: absolute;
        right: 50px;
        top: 40px;
        font-size: 28px;
        font-weight: 800;
        font-style: italic;
        color: rgba(255, 255, 255, 0.1);
        text-align: right;
    }

    .gallery-section {
        margin-top: -50px;
        position: relative;
        z-index: 10;
        margin-bottom: 80px;
    }

    .gallery-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 30px;
    }

    .filter-buttons {
        display: flex;
        justify-content: flex-start;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 0;
    }

    .filter-btn {
        background: #fff;
        border: 1px solid #ddd;
        padding: 10px 24px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }

    .filter-btn:hover, .filter-btn.active {
        background-color: #558b2f;
        color: #fff;
        border-color: #558b2f;
    }

    .upload-btn {
        background-color: #558b2f;
        color: #fff;
        padding: 10px 22px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }

    .upload-btn:hover {
        background-color: #33691e;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }

    .gallery-item {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s;
    }

    .gallery-item:hover {
        transform: translateY(-5px);
    }

    .gallery-item img {
        width: 100%;
        height: 220px !important;
        object-fit: contain;
        display: block;
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    .gallery-caption {
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .gallery-caption i {
        font-size: 18px;
        color: #558b2f;
        background: #e8f5e9;
        padding: 10px;
        border-radius: 8px;
    }

    .gallery-caption h4 {
        font-size: 14px;
        font-weight: 700;
        color: #222;
    }

    .gallery-caption p {
        font-size: 12px;
        color: #777;
    }

    .cta-banner {
        background: linear-gradient(135deg, #0b1c3f 0%, #152c5b 100%);
        border-radius: 16px;
        padding: 50px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #fff;
        margin-bottom: -40px;
        position: relative;
        z-index: 20;
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    .cta-content h2 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .cta-content p {
        font-size: 14px;
        color: #ccc;
    }

    .btn-yellow {
        background-color: #ffb300;
        color: #000;
        padding: 14px 28px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: background 0.3s;
    }

    .btn-yellow:hover {
        background-color: #ffa000;
    }

    @media (max-width: 992px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 991px) {
        .cta-banner {
            height: auto !important;
            padding: 30px 14px !important;
            margin-top: -9px;
        }
        .gallery-section { padding: 60px 20px !important; }
    }

    @media (max-width: 768px) {
        .nav-links, .nav-right .search-icon {
            display: none;
        }
        .gallery-grid {
            grid-template-columns: 1fr;
        }
        .cta-banner {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }

        .gallery-header {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }
        .filter-buttons {
            justify-content: center;
        }
        .upload-form {
            display: flex;
            width: 100%;
        }
        .upload-btn {
            width: 100%;
            text-align: center;
            justify-content: center;
        }
        .gallery-section {
            padding: 60px 20px;
        }
    }
    /* ==========Modal============== */
    .custom-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }
    .custom-modal-content {
        background: #ffffff;
        padding: 25px;
        border-radius: 8px;
        width: 450px;
        max-width: 90%;
        box-shadow: 0px 5px 15px rgba(0,0,0,0.3);
    }
</style>
@section('body')
    <section class="hero">
        <div class="container hero-content">
            <span class="subtitle">OUR GALLERY</span>
            <h1>Moments<br><span>That Inspire.</span></h1>
            <p>Relive the energy, smiles and unforgettable moments from our running events.</p>
        </div>
    </section>

    <section class="gallery-section container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="gallery-header">
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">All</button>
                @php
                    // Shudhu shei category-gulo nibo jar under-e at least ekti approved image ache
                    $categories = \App\Models\GalleryCategory::whereHas('galleries', function($query) {
                        $query->where('status', 1);
                    })->get();
                @endphp
                @foreach($categories as $cat)
                    {{-- data-filter er modhe slug-er bodole category name-er lowercase ar slugified version thik moto match koranor jonno class ba attribute use kora jabe --}}
                    <button class="filter-btn" data-filter="{{ \Str::slug($cat->name) }}">{{ $cat->name }}</button>
                @endforeach
            </div>
            <div class="upload-field-wrapper">
                <button type="button" class="upload-btn" onclick="openModal()">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload Images
                </button>
            </div>
        </div>

        <div class="gallery-grid">
            @foreach($galleries as $item)
                @if(isset($item->status) ? $item->status == 1 : true)
                    {{-- data-category ke \Str::slug($item->category) kore dilam, jate filter button-er slug-er sathe mil thake --}}
                    <div class="gallery-item" data-category="{{ \Str::slug($item->category) }}">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title ?? 'Gallery Image' }}">
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    <section class="cta-banner container">
        <div class="cta-content">
            <h2>Be Part of<br>Our Next Event!</h2>
            <p>Join us for the next running event and be part of a growing community of passionate runners.</p>
        </div>
        <div class="cta-button">
            <a href="#" class="btn-yellow">View Upcoming Events <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </section>

    <div id="uploadModal" class="custom-modal">
        <div class="custom-modal-content" style="background: #cfebbd; max-width: 500px; width: 100%; padding: 20px; border-radius: 8px;">
            <div class="modal-header d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                <h5 class="modal-title m-0"><b>UPLOAD GALLERY IMAGES</b></h5>
                <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close" style="background-color: #dc3545; color: white; border: none; width: 30px; height: 30px; border-radius: 50%; font-size: 1rem; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center;"></button>
            </div>

            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="form-label">Category</label>
                        <div class="flex gap-2">
                            <select name="category" class="form-control w-full" required id="categorySelect">
                                <option value="" disabled selected>Select Category</option>
                                {{-- Modal-er jonno shob category-i thakbe jate user upload korte pare --}}
                                @php
                                    $allCategories = \App\Models\GalleryCategory::all();
                                @endphp
                                @foreach($allCategories as $cat)
                                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                @endforeach
                                <option value="new_category">+ Add New Category</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4 hidden" id="newCategoryBox">
                        <label class="form-label">New Category Name</label>
                        <div class="flex gap-2">
                            <input type="text" id="newCategoryInput" class="form-control" placeholder="Enter new category name">
                            <button type="button" id="saveNewCategoryBtn" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Select Images (Multiple allowed)</label>
                        <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple required>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-end gap-2 mt-4 pt-2 border-top">
                    <button type="submit" class="btn btn-primary">Upload All</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function openModal() {
            const modal = document.getElementById('uploadModal');
            if (modal) {
                modal.style.display = 'flex';
            }
        }

        function closeModal() {
            const modal = document.getElementById('uploadModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('categorySelect');
            const newCategoryBox = document.getElementById('newCategoryBox');
            const newCategoryInput = document.getElementById('newCategoryInput');
            const saveNewCategoryBtn = document.getElementById('saveNewCategoryBtn');
            if (categorySelect) {
                categorySelect.addEventListener('change', function() {
                    if (this.value === 'new_category') {
                        newCategoryBox.classList.remove('hidden');
                    } else {
                        newCategoryBox.classList.add('hidden');
                    }
                });
            }
            if (saveNewCategoryBtn) {
                saveNewCategoryBtn.addEventListener('click', function() {
                    let categoryName = newCategoryInput.value.trim();

                    if (!categoryName) {
                        alert('Please enter a category name');
                        return;
                    }

                    fetch("{{ route('admin.gallery.category.storeAjax') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ name: categoryName })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            let catName = data.category.name;

                            let newOption = document.createElement('option');
                            newOption.value = catName;
                            newOption.textContent = catName;
                            newOption.selected = true;

                            const lastOption = categorySelect.lastElementChild;
                            categorySelect.insertBefore(newOption, lastOption);
                            categorySelect.value = catName;

                            newCategoryInput.value = '';
                            newCategoryBox.classList.add('hidden');
                        } else {
                            let errorMsg = data.message || 'Something went wrong!';
                            alert(errorMsg);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to save category. Please try again.');
                    });
                });
            }
        });
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('filter-btn')) {
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                e.target.classList.add('active');
                const filterValue = e.target.getAttribute('data-filter').trim().toLowerCase();
                document.querySelectorAll('.gallery-item').forEach(item => {
                    const itemCategory = item.getAttribute('data-category') ? item.getAttribute('data-category').trim().toLowerCase() : '';
                    if (filterValue === 'all' || itemCategory === filterValue) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
        });
    </script>
@endsection
