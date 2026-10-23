@extends('master')
<style>
    .hero {
        background: url('img/blog.jpg') !important;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: #fff;
        padding: 80px 0 40px !important;
    }

    .breadcrumb {
        font-size: 13px;
        color: #aaa;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .breadcrumb i {
        font-size: 10px;
    }

    .hero h1 {
        font-size: 42px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .hero h1 span {
        color: #7cb342;
    }

    .hero p {
        font-size: 15px;
        color: #ddd;
        max-width: 600px;
    }

    /* Main Layout: Grid + Sidebar */
    .main-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        margin-top: 40px;
        margin-bottom: 80px;
    }

    .section-tag {
        font-size: 12px;
        font-weight: 700;
        color: #7cb342;
        letter-spacing: 1px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-tag .line {
        width: 25px;
        height: 3px;
        background-color: #7cb342;
        display: inline-block;
    }

    /* Blog Cards Grid */
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }

    .blog-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .blog-img-wrapper {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .blog-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        color: #fff;
    }

    .badge.running-tips { background-color: #43a047; }
    .badge.event-updates { background-color: #fb8c00; }
    .badge.health-fitness { background-color: #039be5; }
    .badge.gear-eq { background-color: #8e24aa; }
    .badge.community { background-color: #00897b; }

    .blog-details {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .blog-details h2 {
        font-size: 16px;
        font-weight: 700;
        color: #111;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .blog-details p {
        font-size: 13px;
        color: #666;
        margin-bottom: 15px;
        line-height: 1.5;
        flex-grow: 1;
    }

    .blog-meta {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        color: #888;
        margin-bottom: 15px;
        border-top: 1px solid #f0f0f0;
        padding-top: 12px;
    }

    .blog-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .read-more {
        font-size: 13px;
        font-weight: 700;
        color: #2e7d32;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: gap 0.3s;
    }

    .read-more:hover {
        gap: 10px;
    }

    /* Pagination */
    .pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 40px;
    }

    .page-btn {
        width: 38px;
        height: 38px;
        background: #fff;
        border: 1px solid #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        color: #333;
        transition: all 0.3s;
    }

    .page-btn.active, .page-btn:hover {
        background-color: #0c9237;
        color: #fff;
        border-color: #0b1c3f;
    }

    .dots {
        color: #777;
        padding: 0 5px;
    }

    /* Sidebar Widgets */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .widget {
        background: #eff7e9;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
    }

    .widget h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 8px;
    }

    .widget h3::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 30px;
        height: 2px;
        background-color: #7cb342;
    }

    /* Search Widget */
    .search-box {
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 12px 40px 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 13px;
        outline: none;
        transition: border-color 0.3s;
    }

    .search-box input:focus {
        border-color: #558b2f;
    }

    .search-box i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #777;
        font-size: 14px;
    }

    /* Categories Widget */
    .categories-widget ul {
        list-style: none;
    }

    .categories-widget ul li {
        border-bottom: 1px solid #f2f2f2;
        padding: 10px 0;
    }

    .categories-widget ul li:last-child {
        border-bottom: none;
    }

    .categories-widget ul li a {
        text-decoration: none;
        color: #555;
        font-size: 13px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: color 0.3s;
    }

    .categories-widget ul li a:hover {
        color: #2e7d32;
    }

    .categories-widget ul li a .count {
        background: #f0f0f0;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 11px;
        color: #666;
    }

    .categories-widget ul li a .count.active-count {
        background: #558b2f;
        color: #fff;
    }

    /* Recent Posts Widget */
    .recent-post-item {
        display: flex;
        gap: 12px;
        margin-bottom: 15px;
        align-items: center;
    }

    .recent-post-item:last-child {
        margin-bottom: 0;
    }

    .recent-post-item img {
        width: 65px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }

    .recent-post-item h4 a {
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        color: #222;
        line-height: 1.3;
        display: block;
        margin-bottom: 4px;
        transition: color 0.3s;
    }

    .recent-post-item h4 a:hover {
        color: #2e7d32;
    }

    .recent-post-item span {
        font-size: 11px;
        color: #888;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Story Banner Widget */
    .story-banner {
        background: linear-gradient(135deg, #e8f5e9 0%, #f1f8e9 100%);
        border: 1px dashed #aed581;
    }

    .story-content h3 {
        color: #1b5e20;
    }

    .story-content p {
        font-size: 13px;
        color: #444;
        margin-bottom: 15px;
    }

    .btn-green {
        background-color: #558b2f;
        color: #fff;
        padding: 10px 20px;
        border-radius: 20px;
        text-decoration: none;
        font-weight: 700;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.3s;
    }

    .btn-green:hover {
        background-color: #33691e;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .main-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .nav-links, .nav-right .search-icon {
            display: none;
        }
        .blog-grid {
            grid-template-columns: 1fr;
        }
    }
    /* ================Modal=============== */
    /* Modal Overlay */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        width: 100%;
        max-width: 500px;
        position: relative;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        animation: fadeIn 0.3s ease-in-out;
    }

    .close-modal {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 24px;
        cursor: pointer;
        color: #777;
    }

    .close-modal:hover {
        color: #000;
    }

    .modal-content h2 {
        font-size: 20px;
        margin-bottom: 20px;
        color: #111;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #444;
    }

    .form-group input, .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 13px;
        outline: none;
    }

    .form-group input:focus, .form-group textarea:focus {
        border-color: #558b2f;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .w-100 {
        width: 100%;
        justify-content: center;
        cursor: pointer;
        border: none;
    }
</style>
@section('body')
    <section class="hero" style="background-image: url('img/blog.jpg');">
        <div class="container hero-content">
            <div class="breadcrumb">Home <i class="fa-solid fa-chevron-right"></i> Blog</div>
            <h1>Our <span>Blog</span></h1>
            <p>Stay updated with the latest news, running tips, event highlights and stories from our community.</p>
        </div>
    </section>
    <div class="container main-layout" style="padding-top: 20px;">
        <main class="blog-content">
            <div class="flex flex-col" style="padding-bottom: 10px;">
                <h2 class="text-[30px] font-bold text-[#7bb526] tracking-wider uppercase mb-1">LATEST BLOGS</h2>
            </div>

            <div class="blog-grid">
                @foreach($blogs as $blog)
                    <article class="blog-card cursor-pointer" onclick='openBlogModal(@json($blog))'>
                        <div class="blog-img-wrapper">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                        </div>
                        <div class="blog-details">
                            <h2>{{ $blog->title }}</h2>
                            <p>{{ Str::limit($blog->description, 120) }}</p>
                            <div class="blog-meta">
                                <span><i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($blog->date ?? $blog->created_at)->format('M d, Y') }}</span>
                                {{-- <span><i class="fa-regular fa-comment"></i> {{ $blog->comments_count ?? '0' }} Comments</span> --}}
                                <span class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></span>
                            </div>

                        </div>
                    </article>
                @endforeach
            </div>

            <div class="pagination">
                {{ $blogs->links() }}
            </div>
            <br>
        </main>
        <aside class="sidebar">
            <div class="widget search-widget">
                <h3>Search Blog</h3>
                <div class="search-box relative">
                    <input type="text" id="blogSearchInput" placeholder="Search articles..." onkeyup="filterBlogs(this.value)" class="w-full">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>

            <script>
                function filterBlogs(keyword) {
                    const query = keyword.toLowerCase().trim();
                    const cards = document.querySelectorAll('.blog-card');

                    cards.forEach(card => {
                        const title = card.querySelector('h2').innerText.toLowerCase();
                        const desc = card.querySelector('p').innerText.toLowerCase();

                        if (title.includes(query) || desc.includes(query)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                }
            </script>

            {{-- <div class="widget categories-widget">
                <h3>Categories</h3>
                <ul>
                    <li><a href="#"><span>All Posts</span> <span class="count active-count">24</span></a></li>
                    <li><a href="#"><span>Event Updates</span> <span class="count">8</span></a></li>
                    <li><a href="#"><span>Running Tips</span> <span class="count">6</span></a></li>
                    <li><a href="#"><span>Health & Fitness</span> <span class="count">5</span></a></li>
                    <li><a href="#"><span>Gear & Equipment</span> <span class="count">3</span></a></li>
                    <li><a href="#"><span>Community</span> <span class="count">2</span></a></li>
                </ul>
            </div> --}}
            <div class="widget story-banner">
                <div class="story-content">
                    <h3>Have a story to share?</h3>
                    <p>Write for our blog and inspire the running community!</p>
                    <a href="#" id="openModalBtn" class="btn-green">Write Your Blog <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
            <!-- Recent Posts Widget -->
            <div class="widget recent-posts-widget">
                <h3>Recent Posts</h3>
                @php
                    $recentBlogs = \App\Models\Blog::latest()->take(4)->get();
                @endphp

                @foreach($recentBlogs as $blog)
                    <div class="recent-post-item" onclick='openBlogModal(@json($blog))'>
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                        <div>
                            <h4><a href="#">{{ $blog->title }}</a></h4>
                            <span><i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($blog->date ?? $blog->created_at)->format('M d, Y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </aside>
        <br>
    </div>
    <!-- Submit Article Modal -->
    <div id="successModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 99999; justify-content: center; align-items: center;">
        <div style="background: #ffffff; padding: 40px 30px; border-radius: 16px; width: 100%; max-width: 420px; position: relative; box-shadow: 0 10px 25px rgba(0,0,0,0.2); text-align: center;">
            <div style="width: 70px; height: 70px; background: #e6f4ea; color: #137333; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; margin: 0 auto 20px auto;">✓</div>
            <h3 style="font-size: 22px; color: #021540; margin-bottom: 15px;">Success!</h3>
            <p style="font-size: 15px; color: #555; line-height: 1.5; margin-bottom: 25px;">Your article has been submitted successfully! It will be visible after admin approval.</p>
            <button type="button" id="closeSuccessModalBtn" style="padding: 12px 30px; background: #7bb526; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 15px; width: 100%;">OK</button>
        </div>
    </div>

    <div id="articleModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 99998; justify-content: center; align-items: center;">
        <div style="background: #f0f5f2; padding: 30px; border-radius: 12px; width: 100%; max-width: 500px; position: relative; box-shadow: 0 5px 20px rgba(0,0,0,0.2);">
            <span id="closeModalBtn" style="position: absolute; top: 15px; right: 20px; font-size: 24px; cursor: pointer; color: #777;">&times;</span>
            <h2 style="font-size: 20px; margin-bottom: 20px; color: #021540;">Submit Your Article</h2>

            <div id="formErrors" style="display: none; background: #f8d7da; color: #721c24; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-size: 13px;">
                <ul id="errorList" style="margin: 0; padding-left: 15px;"></ul>
            </div>

            <form id="ajaxBlogForm" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #444;">Article Title</label>
                    <input type="text" name="title" required autocomplete="off" placeholder="Enter title..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #444;">Description</label>
                    <textarea name="description" rows="3" required placeholder="Write your article..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;"></textarea>
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #444;">Date</label>
                    <input type="date" name="date" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #444;">Upload Picture</label>
                    <input type="file" name="image" accept="image/*" required style="width: 100%;">
                </div>

                <button type="submit" id="submitBlogBtn" style="width: 100%; padding: 12px; background: #7bb526; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">Publish Article</button>
            </form>
        </div>
    </div>

    <div id="blogDetailModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm hidden p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden relative max-h-[90vh] flex flex-col">
            <div class="p-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h3 class="font-bold text-slate-800 text-lg" id="modalBlogTitle">Blog Title</h3>
                <button type="button" onclick="closeBlogModal()" class="w-8 h-8 rounded-full bg-slate-200 hover:bg-slate-300 text-slate-600 flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto space-y-4">
                <div id="modalBlogImgWrapper" class="w-full h-64 rounded-xl overflow-hidden hidden">
                    <img id="modalBlogImg" src="" alt="" class="w-full h-full object-cover">
                </div>
                <p class="text-xs text-slate-400" id="modalBlogDate"></p>
                <div class="text-slate-600 text-sm leading-relaxed whitespace-pre-line" id="modalBlogDesc"></div>
            </div>
        </div>
    </div>

    <script>
        function openBlogModal(blog) {
            document.getElementById('modalBlogTitle').innerText = blog.title;
            document.getElementById('modalBlogDesc').innerText = blog.description;

            const dateStr = blog.date || blog.created_at;
            const formattedDate = dateStr ? new Date(dateStr).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '';
            document.getElementById('modalBlogDate').innerText = formattedDate;

            const imgWrapper = document.getElementById('modalBlogImgWrapper');
            const imgTag = document.getElementById('modalBlogImg');
            if (blog.image) {
                imgTag.src = "{{ asset('storage/') }}/" + blog.image;
                imgWrapper.classList.remove('hidden');
            } else {
                imgWrapper.classList.add('hidden');
            }

            document.getElementById('blogDetailModal').classList.remove('hidden');
        }

        function closeBlogModal() {
            document.getElementById('blogDetailModal').classList.add('hidden');
        }

        document.getElementById('blogDetailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBlogModal();
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById('articleModal');
            const successModal = document.getElementById('successModal');
            const submitBtn = document.querySelector('.btn-green');
            const closeBtn = document.getElementById('closeModalBtn');
            const closeSuccessBtn = document.getElementById('closeSuccessModalBtn');
            const blogForm = document.getElementById('ajaxBlogForm');

            if (submitBtn) {
                submitBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    modal.style.display = 'flex';
                });
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', function () {
                    modal.style.display = 'none';
                });
            }

            if (closeSuccessBtn) {
                closeSuccessBtn.addEventListener('click', function () {
                    successModal.style.display = 'none';
                });
            }

            window.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
                if (e.target === successModal) {
                    successModal.style.display = 'none';
                }
            });

            if (blogForm) {
                blogForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const formData = new FormData(blogForm);
                    const submitButton = document.getElementById('submitBlogBtn');
                    submitButton.disabled = true;
                    submitButton.innerText = 'Submitting...';

                    fetch("{{ route('blog.store') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json().catch(() => ({}));
                        } else if (response.status === 422) {
                            return response.json().then(data => { throw data; });
                        } else {
                            throw new Error('Something went wrong!');
                        }
                    })
                    .then(data => {
                        modal.style.display = 'none';
                        blogForm.reset();
                        submitButton.disabled = false;
                        submitButton.innerText = 'Publish Article';

                        const errorDiv = document.getElementById('formErrors');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }

                        successModal.style.display = 'flex';
                    })
                    .catch(errorData => {
                        submitButton.disabled = false;
                        submitButton.innerText = 'Publish Article';

                        const errorDiv = document.getElementById('formErrors');
                        const errorList = document.getElementById('errorList');

                        if (errorList) {
                            errorList.innerHTML = '';

                            if (errorData.errors) {
                                Object.values(errorData.errors).forEach(messages => {
                                    messages.forEach(msg => {
                                        const li = document.createElement('li');
                                        li.innerText = msg;
                                        errorList.appendChild(li);
                                    });
                                });
                                if (errorDiv) {
                                    errorDiv.style.display = 'block';
                                }
                            }
                        }
                    });
                });
            }
        });
    </script>
@endsection
