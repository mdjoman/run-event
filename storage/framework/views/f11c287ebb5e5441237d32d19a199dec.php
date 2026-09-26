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
        background: #fff;
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
<?php $__env->startSection('body'); ?>
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
                <!-- Blog Card 1 -->
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        <img src="<?php echo e(asset('img/home1.jpg')); ?>" alt="Running Tips">
                    </div>
                    <div class="blog-details">
                        <h2>10 Essential Running Tips for Beginners</h2>
                        <p>Starting your running journey? Here are 10 simple and effective tips to help you run safer, stay motivated and achieve your goals.</p>
                        <div class="blog-meta">
                            <span><i class="fa-regular fa-calendar"></i> May 20, 2025</span>
                            <span><i class="fa-regular fa-comment"></i> 3 Comments</span>
                        </div>
                        <a href="#" class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Blog Card 2 -->
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        <img src="<?php echo e(asset('img/dhakarun.jpeg')); ?>" alt="Event Updates">
                    </div>
                    <div class="blog-details">
                        <h2>Run Sirajganj 2025: A Journey of Unity and Fitness</h2>
                        <p>Relive the excitement, energy and unforgettable moments from Run Sirajganj 2025. Thank you to everyone who made it special!</p>
                        <div class="blog-meta">
                            <span><i class="fa-regular fa-calendar"></i> Apr 15, 2025</span>
                            <span><i class="fa-regular fa-comment"></i> 5 Comments</span>
                        </div>
                        <a href="#" class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Blog Card 3 -->
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        <img src="<?php echo e(asset('img/ur1.jpeg')); ?>" alt="Health & Fitness">
                    </div>
                    <div class="blog-details">
                        <h2>How Running Improves Your Mental Health</h2>
                        <p>Running isn’t just good for your body — it’s also great for your mind. Discover how regular runs can reduce stress and boost your mood.</p>
                        <div class="blog-meta">
                            <span><i class="fa-regular fa-calendar"></i> Apr 03, 2025</span>
                            <span><i class="fa-regular fa-comment"></i> 2 Comments</span>
                        </div>
                        <a href="#" class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Blog Card 4 -->
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        <img src="<?php echo e(asset('img/ur2.jpeg')); ?>" alt="Gear & Equipment">
                    </div>
                    <div class="blog-details">
                        <h2>Choosing the Right Running Shoes for Your Needs</h2>
                        <p>The right pair of running shoes can make a big difference. Learn how to choose the best shoes based on your running style and goals.</p>
                        <div class="blog-meta">
                            <span><i class="fa-regular fa-calendar"></i> Apr 18, 2025</span>
                            <span><i class="fa-regular fa-comment"></i> 4 Comments</span>
                        </div>
                        <a href="#" class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Blog Card 5 -->
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        <img src="<?php echo e(asset('img/ur5.jpeg')); ?>" alt="Community">
                    </div>
                    <div class="blog-details">
                        <h2>The Power of Running Communities</h2>
                        <p>Running is better together! Find out how running communities like Run Burjowan bring people together, create friendships and build a healthier lifestyle.</p>
                        <div class="blog-meta">
                            <span><i class="fa-regular fa-calendar"></i> Mar 05, 2025</span>
                            <span><i class="fa-regular fa-comment"></i> 1 Comment</span>
                        </div>
                        <a href="#" class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <!-- Blog Card 6 -->
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        <img src="<?php echo e(asset('img/ur4.jpeg')); ?>" alt="Event Updates">
                    </div>
                    <div class="blog-details">
                        <h2>What to Expect in Our Next Event</h2>
                        <p>Get ready for the next Run Burjowan event! Here’s a quick look at what you can expect, from the route to the activities and special highlights.</p>
                        <div class="blog-meta">
                            <span><i class="fa-regular fa-calendar"></i> Feb 20, 2025</span>
                            <span><i class="fa-regular fa-comment"></i> 3 Comments</span>
                        </div>
                        <a href="#" class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <a href="#" class="page-btn"><i class="fa-solid fa-chevron-left"></i></a>
                <a href="#" class="page-btn active">1</a>
                <a href="#" class="page-btn">2</a>
                <a href="#" class="page-btn">3</a>
                <span class="dots">...</span>
                <a href="#" class="page-btn">5</a>
                <a href="#" class="page-btn"><i class="fa-solid fa-chevron-right"></i></a>
            </div>
            <br>
        </main>

        <aside class="sidebar">
            <div class="widget search-widget">
                <h3>Search Blog</h3>
                <div class="search-box">
                    <input type="text" placeholder="Search articles...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>

            <div class="widget categories-widget">
                <h3>Categories</h3>
                <ul>
                    <li><a href="#"><span>All Posts</span> <span class="count active-count">24</span></a></li>
                    <li><a href="#"><span>Event Updates</span> <span class="count">8</span></a></li>
                    <li><a href="#"><span>Running Tips</span> <span class="count">6</span></a></li>
                    <li><a href="#"><span>Health & Fitness</span> <span class="count">5</span></a></li>
                    <li><a href="#"><span>Gear & Equipment</span> <span class="count">3</span></a></li>
                    <li><a href="#"><span>Community</span> <span class="count">2</span></a></li>
                </ul>
            </div>

            <!-- Recent Posts Widget -->
            <div class="widget recent-posts-widget">
                <h3>Recent Posts</h3>
                <div class="recent-post-item">
                    <img src="<?php echo e(asset('img/home1.jpg')); ?>" alt="Post">
                    <div>
                        <h4><a href="#">10 Essential Running Tips for Beginners</a></h4>
                        <span><i class="fa-regular fa-calendar"></i> May 20, 2025</span>
                    </div>
                </div>
                <div class="recent-post-item">
                    <img src="<?php echo e(asset('img/ur1.jpeg')); ?>" alt="Post">
                    <div>
                        <h4><a href="#">Run Sirajganj 2025: A Journey of Unity...</a></h4>
                        <span><i class="fa-regular fa-calendar"></i> Apr 15, 2025</span>
                    </div>
                </div>
                <div class="recent-post-item">
                    <img src="<?php echo e(asset('img/ur2.jpeg')); ?>" alt="Post">
                    <div>
                        <h4><a href="#">Choosing the Right Running Shoes...</a></h4>
                        <span><i class="fa-regular fa-calendar"></i> Mar 18, 2025</span>
                    </div>
                </div>
                <div class="recent-post-item">
                    <img src="<?php echo e(asset('img/ur3.jpeg')); ?>" alt="Post">
                    <div>
                        <h4><a href="#">How Running Improves Your Mental Health</a></h4>
                        <span><i class="fa-regular fa-calendar"></i> Apr 02, 2025</span>
                    </div>
                </div>
            </div>

            <div class="widget story-banner">
                <div class="story-content">
                    <h3>Have a story to share?</h3>
                    <p>Write for our blog and inspire the running community!</p>
                    <a href="#" id="openModalBtn" class="btn-green">Submit Your Article <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </aside>
    </div>
    <!-- Submit Article Modal -->
    <div id="articleModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 99999; justify-content: center; align-items: center;">
        <div style="background: #f0f5f2; padding: 30px; border-radius: 12px; width: 100%; max-width: 500px; position: relative; box-shadow: 0 5px 20px rgba(0,0,0,0.2);">
            <span class="modal-close" id="closeModalBtn" style="position: absolute; top: 15px; right: 20px; font-size: 24px; cursor: pointer; color: #777;">&times;</span>
            <h2 style="font-size: 20px; margin-bottom: 20px; color: #021540;">Submit Your Article</h2>

            <form action="<?php echo e(route('blog.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #444;">Article Title</label>
                    <input type="text" name="title" required placeholder="Enter title..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
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

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #444;">Passcode</label>
                    <input type="password" name="passcode" required placeholder="Enter secret passcode..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <button type="submit" style="width: 100%; padding: 12px; background: #7bb526; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">Publish Article</button>
            </form>
        </div>
    </div>
    <script>
        const searchInput = document.querySelector('.search-box input');
        if (searchInput) {
            searchInput.addEventListener('keyup', (e) => {
                const term = e.target.value.toLowerCase();
                const blogCards = document.querySelectorAll('.blog-card');

                blogCards.forEach(card => {
                    const title = card.querySelector('h2').innerText.toLowerCase();
                    const desc = card.querySelector('p').innerText.toLowerCase();

                    if (title.includes(term) || desc.includes(term)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
        /*=======================================================*/
        // Modal Functionality
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById('articleModal');
            const submitBtn = document.querySelector('.btn-green');
            const closeBtn = document.getElementById('closeModalBtn');

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

            window.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\run-event\resources\views/blog.blade.php ENDPATH**/ ?>