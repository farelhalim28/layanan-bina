{{-- FILE: resources/views/layouts/admin/footer.blade.php --}}

<style>
    .developer-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 80px 0;
        margin-top: 60px;
        color: white;
        position: relative;
        overflow: hidden;
        border-radius: 50px 50px 0 0;
    }

    .developer-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.05)"/></svg>');
        opacity: 0.3;
    }

    .developer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 1;
    }

    .developer-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .developer-title h2 {
        font-size: 32px;
        font-weight: 800;
        margin: 0 0 10px 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .developer-title p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }

    .developer-card {
        background: white;
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 40px;
        align-items: center;
    }

    .developer-photo-section {
        text-align: center;
    }

    .developer-photo {
        width: 200px;
        height: 200px;
        border-radius: 25px;
        object-fit: cover;
        border: 6px solid #f8fafc;
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.25);
        margin-bottom: 20px;
    }

    .developer-role {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .developer-info {
        color: #2d3748;
    }

    .developer-name {
        font-size: 32px;
        font-weight: 800;
        margin: 0 0 8px 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .developer-subtitle {
        font-size: 16px;
        color: #718096;
        margin: 0 0 30px 0;
        font-weight: 600;
    }

    .developer-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .detail-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .detail-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        flex-shrink: 0;
    }

    .detail-content {
        flex: 1;
    }

    .detail-label {
        font-size: 11px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .detail-value {
        font-size: 14px;
        font-weight: 600;
        color: #2d3748;
    }

    .developer-social {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s;
        border: 2px solid #e2e8f0;
        color: #2d3748;
    }

    .social-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .social-link.linkedin {
        background: #0077b5;
        color: white;
        border-color: #0077b5;
    }

    .social-link.github {
        background: #24292e;
        color: white;
        border-color: #24292e;
    }

    .social-link.instagram {
        background: linear-gradient(135deg, #833ab4 0%, #fd1d1d 50%, #fcb045 100%);
        color: white;
        border: none;
    }

    .social-link.email {
        background: #ea4335;
        color: white;
        border-color: #ea4335;
    }

    .social-link.whatsapp {
        background: #25d366;
        color: white;
        border-color: #25d366;
    }

    .copyright-text {
        text-align: center;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        font-size: 13px;
        opacity: 0.9;
    }

    @media (max-width: 992px) {
        .developer-card {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .developer-details {
            grid-template-columns: 1fr;
        }

        .detail-item {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .developer-social {
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .developer-section {
            padding: 40px 0;
        }

        .developer-card {
            padding: 30px 20px;
        }

        .developer-photo {
            width: 150px;
            height: 150px;
        }

        .developer-name {
            font-size: 24px;
        }

        .developer-details {
            gap: 15px;
        }
    }
</style>

{{-- Developer Identity Section --}}
<div class="developer-section">
    <div class="developer-container">
        {{-- Title --}}
        <div class="developer-title">
            <h2> Pengembang Sistem</h2>
            <p>Dibuat untuk Sistem Bina Desa</p>
        </div>

        {{-- Developer Card --}}
        <div class="developer-card">
            {{-- Photo Section --}}
            <div class="developer-photo-section">
                <img src="{{ asset('assets-admin/images/bg/photo.jpg') }}"
                     alt="Developer Photo"
                     class="developer-photo"
                     onerror="this.src='https://ui-avatars.com/api/?name=Developer&size=200&background=667eea&color=fff&font-size=0.4'">
                <div>
                    <span class="developer-role">👨‍🎓 Mahasiswa</span>
                </div>
            </div>

            {{-- Info Section --}}
            <div class="developer-info">
                <h3 class="developer-name">Farel Abdul Halim</h3>
                <p class="developer-subtitle">Developer & Web Designer</p>

                {{-- Details Grid --}}
                <div class="developer-details">
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">NIM</div>
                            <div class="detail-value">2457301049</div>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Program Studi</div>
                            <div class="detail-value">Sistem Informasi</div>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Universitas</div>
                            <div class="detail-value">Politeknik Caltex Riau</div>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Tahun Angkatan</div>
                            <div class="detail-value">2024</div>
                        </div>
                    </div>
                </div>

                {{-- Social Links --}}
                <div class="developer-social">
                    <a href="https://www.linkedin.com/in/farel-abdul-halim-b2008439a/" target="_blank" class="social-link linkedin">
                        <i class="bi bi-linkedin"></i>
                        <span>LinkedIn</span>
                    </a>

                    <a href="https://github.com/farelhalim28" target="_blank" class="social-link github">
                        <i class="bi bi-github"></i>
                        <span>GitHub</span>
                    </a>

                    <a href="https://www.instagram.com/farel_jnr?igsh=aGlvMmNjcnZnOGc3" target="_blank" class="social-link instagram">
                        <i class="bi bi-instagram"></i>
                        <span>Instagram</span>
                    </a>

                    <a href="mailto:farel24si@mahasiswa.pcr.ac.id" class="social-link email">
                        <i class="bi bi-envelope-fill"></i>
                        <span>Email</span>
                    </a>

                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="copyright-text">
            © 2025 Sistem Bina Desa - Desa Penyasawan | Developed by <strong>Farel Abdul Halim</strong>
            <br>
            <small>Platform Layanan Mandiri & Surat Digital</small>
        </div>
    </div>
</div>
