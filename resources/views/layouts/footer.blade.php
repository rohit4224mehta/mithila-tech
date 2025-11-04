<!-- Information Governance Use Cases with Hover -->
<section class="py-16 bg-gray-100" @if(in_array(Request::path(), ['login', 'register','dashboard','updatePassword','projects','projectDetail', 'forgot-password', 'reset-password/*'])) style="display: none;" @endif>
    <div class="container text-center">
        <h2 class="fw-bold text-4xl mb-6 text-gray-900">Explore Information Governance Use Cases</h2>
        <p class="lead mb-8 text-gray-600 mx-auto" style="max-width: 850px;">
            Mithila Tech helps organizations manage their information responsibly and securely. Discover how our solutions solve real-world challenges.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="card h-100 border-0 shadow-md hover:shadow-xl transition-shadow duration-300 p-6 bg-white rounded-lg">
                <div class="mb-4 text-blue-600">
                    <i class="bi bi-shield-lock fs-2"></i>
                </div>
                <h5 class="card-title text-xl">Data Privacy Compliance</h5>
                <p class="card-text text-gray-600">Ensure compliance with GDPR and HIPAA using smart data governance tools.</p>
            </div>
            <div class="card h-100 border-0 shadow-md hover:shadow-xl transition-shadow duration-300 p-6 bg-white rounded-lg">
                <div class="mb-4 text-green-600">
                    <i class="bi bi-folder-symlink fs-2"></i>
                </div>
                <h5 class="card-title text-xl">Records Management</h5>
                <p class="card-text text-gray-600">Digitize and manage records efficiently to support audits and reduce costs.</p>
            </div>
            <div class="card h-100 border-0 shadow-md hover:shadow-xl transition-shadow duration-300 p-6 bg-white rounded-lg">
                <div class="mb-4 text-red-600">
                    <i class="bi bi-trash3 fs-2"></i>
                </div>
                <h5 class="card-title text-xl">ROT Data Clean-Up</h5>
                <p class="card-text text-gray-600">Remove Redundant, Obsolete, and Trivial data to cut costs and risks.</p>
            </div>
            <div class="card h-100 border-0 shadow-md hover:shadow-xl transition-shadow duration-300 p-6 bg-white rounded-lg">
                <div class="mb-4 text-yellow-600">
                    <i class="bi bi-gear fs-2"></i>
                </div>
                <h5 class="card-title text-xl">Automated Data Classification</h5>
                <p class="card-text text-gray-600">Classify sensitive data automatically with AI and smart tagging.</p>
            </div>
            <div class="card h-100 border-0 shadow-md hover:shadow-xl transition-shadow duration-300 p-6 bg-white rounded-lg">
                <div class="mb-4 text-gray-800">
                    <i class="bi bi-lock-fill fs-2"></i>
                </div>
                <h5 class="card-title text-xl">Legal Hold & Discovery</h5>
                <p class="card-text text-gray-600">Preserve and retrieve records quickly for legal matters or audits.</p>
            </div>
            <div class="card h-100 border-0 shadow-md hover:shadow-xl transition-shadow duration-300 p-6 bg-white rounded-lg">
                <div class="mb-4 text-info">
                    <i class="bi bi-cloud-check fs-2"></i>
                </div>
                <h5 class="card-title text-xl">Cloud Governance</h5>
                <p class="card-text text-gray-600">Secure and manage data across cloud platforms like AWS and Azure.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action with Animation -->
<section class="py-16 bg-gradient-to-r from-gray-900 to-gray-800 text-white text-center" @if(in_array(Request::path(), ['login', 'register','dashboard','updatePassword','projects','projectDetail', 'forgot-password', 'reset-password/*'])) style="display: none;" @endif>
    <div class="container">
        <h2 class="fw-bold text-4xl mb-6 animate__animated animate__fadeIn">Let’s Build Something Together</h2>
        <p class="lead mb-8 text-gray-300">Whether you’re a startup, investor, or tech enthusiast — let’s connect and create the future together.</p>
        <a href="{{ route('contact') }}" class="btn btn-warning btn-lg shadow-xl hover:scale-110 transition-transform duration-300 bg-yellow-600 hover:bg-yellow-700 text-white animate__animated animate__fadeInUp">Contact Us</a>
    </div>
</section>

<footer class="footer bg-dark text-light pt-5 pb-3" style="background: linear-gradient(180deg, #0e0f11, #1e293b);">
    <div class="container">
        <div class="row">
            <!-- Logo & Newsletter -->
            <div class="col-md-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/mithila-tech-logo.png') }}" alt="Mithila Tech Logo" width="50" class="me-2">
                    <h4 class="mb-0">Mithila <span class="text-primary">Tech</span></h4>
                </div>
                <p class="fw-bold text-warning">Subscribe for news & updates.</p>
                <form>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Enter your email address" aria-label="Email">
                        <button class="btn btn-warning text-white fw-bold" type="submit">Submit</button>
                    </div>
                </form>
            </div>

            <!-- Platform -->
            <div class="col-md-2 mb-4">
                <h6 class="fw-bold text-white-50 mb-3">Platform</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none link-hover">PowerHouse</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none link-hover">BlackCat</a></li>
                    <li><a href="#" class="text-light text-decoration-none link-hover">Connectors</a></li>
                </ul>
            </div>

            <!-- Solutions -->
            <div class="col-md-3 mb-4">
                <h6 class="fw-bold text-white-50 mb-3">Solutions</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none link-hover">Data Discovery & Classification</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none link-hover">ROT & File Clean-up</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none link-hover">Records Management</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none link-hover">Data Privacy & GRC</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none link-hover">Legal Hold & eDiscovery</a></li>
                    <li><a href="#" class="text-light text-decoration-none link-hover">AI Readiness</a></li>
                </ul>
            </div>

            <!-- Resources & Company -->
            <div class="col-md-3 mb-4">
                <h6 class="fw-bold text-white-50 mb-3">Resources</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="/" class="text-light text-decoration-none link-hover">Upcoming Webinars</a></li>
                    <li class="mb-2"><a href="/" class="text-light text-decoration-none link-hover">On-Demand Webinars</a></li>
                    <li class="mb-2"><a href="/" class="text-light text-decoration-none link-hover">Blog</a></li>
                    <li><a href="/" class="text-light text-decoration-none link-hover">FAQ</a></li>
                </ul>
                <h6 class="fw-bold text-white-50 mt-4 mb-3">Company</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="/" class="text-light text-decoration-none link-hover">About Us</a></li>
                    <li class="mb-2"><a href="/" class="text-light text-decoration-none link-hover">Contact Us</a></li>
                    <li><a href="/" class="text-light text-decoration-none link-hover">Client Input Form</a></li>
                </ul>
                <!-- Social Icons -->
                <div class="mt-2">
                    <a href="/" class="text-light me-3 link-hover"><i class="fab fa-linkedin fa-lg"></i></a>
                    <a href="/" class="text-light link-hover"><i class="fab fa-youtube fa-lg"></i></a>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="text-center mt-4 border-top pt-3 small">
            <p class="mb-0 text">
                Copyright © 2025 <span class="text-warning fw-bold">Mithila Tech</span>. All Rights Reserved.
                | <a href="{{ route('privacy') }}" class="text-warning text-decoration-none link-hover">Privacy Policy</a><br>
                All trademarks, logos and brand names are the property of their respective owners.
            </p>
        </div>
    </div>
</footer>

<style>
    .footer {
        font-family: 'Poppins', sans-serif;
        color: #ffffff;
    }

    .footer a {
        color: #93c5fd;
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .link-hover:hover {
        color: #bfdbfe !important;
        transform: translateX(5px);
    }

    .footer .fab {
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .footer .fab:hover {
        color: #93c5fd;
        transform: scale(1.2);
    }

    .footer h6 {
        letter-spacing: 1px;
        font-size: 1.1rem;
    }

    .footer img {
        transition: transform 0.3s ease;
    }

    .footer img:hover {
        transform: scale(1.1);
    }

    .border-top {
        border-color: #93c5fd !important;
        opacity: 0.25;
    }

    @media (max-width: 768px) {
        .col-md-4, .col-md-2, .col-md-3 {
            flex: 0 0 100%;
            max-width: 100%;
            text-align: center;
        }
        .input-group {
            flex-direction: column;
        }
        .input-group .btn {
            margin-top: 0.5rem;
        }
        .social-icons {
            justify-content: center;
        }
    }
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">