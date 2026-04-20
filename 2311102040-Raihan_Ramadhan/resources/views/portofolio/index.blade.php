<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ config('app.name', 'Portfolio') }} — Raihan Ramadhan</title>
  <meta name="description" content="CV dan Portfolio Online Raihan Ramadhan - Mahasiswa Teknik Informatika Telkom University Purwokerto" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />

  <style>
:root {
  --navy:       #0a1628;
  --navy2:      #0f2040;
  --blue:       #1d6cf0;
  --blue-mid:   #2563eb;
  --blue-light: #3b82f6;
  --blue-pale:  #eff6ff;
  --blue-soft:  #dbeafe;
  --sky:        #e0f2fe;
  --cyan:       #06b6d4;
  --white:      #ffffff;
  --off-white:  #f8fafc;
  --gray-100:   #f1f5f9;
  --gray-200:   #e2e8f0;
  --gray-400:   #94a3b8;
  --gray-600:   #475569;
  --gray-800:   #1e293b;
  --text:       #0f172a;
  --text-muted: #64748b;
  --font-display: 'Syne', sans-serif;
  --font-body: 'Outfit', sans-serif;
  --font-mono: 'JetBrains Mono', monospace;
  --radius-sm: 6px; --radius-md: 14px; --radius-lg: 24px;
  --shadow-sm: 0 1px 3px rgba(0,0,0,.08);
  --shadow-md: 0 4px 24px rgba(29,108,240,.12);
  --shadow-lg: 0 20px 60px rgba(29,108,240,.18);
  --shadow-card: 0 2px 16px rgba(15,32,64,.07);
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{background:var(--white);color:var(--text);font-family:var(--font-body);font-weight:400;line-height:1.7;overflow-x:hidden}
::selection{background:var(--blue-light);color:#fff}
a{color:inherit;text-decoration:none}
img{display:block;max-width:100%}
::-webkit-scrollbar{width:5px}
::-webkit-scrollbar-track{background:var(--gray-100)}
::-webkit-scrollbar-thumb{background:var(--blue-light);border-radius:99px}

#progress-bar{position:fixed;top:0;left:0;height:3px;width:0;background:linear-gradient(90deg,var(--blue),var(--cyan));z-index:1001;border-radius:0 2px 2px 0;transition:width .1s;box-shadow:0 0 12px rgba(29,108,240,.5)}

.site-nav{position:fixed;top:0;left:0;right:0;padding:1rem 0;z-index:900;background:transparent;transition:all .35s ease}
.site-nav.scrolled{background:rgba(255,255,255,0.92);backdrop-filter:blur(16px);box-shadow:0 1px 0 var(--gray-200),0 4px 20px rgba(0,0,0,.06)}
.nav-inner{display:flex;align-items:center;justify-content:space-between}
.nav-logo{font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--white);letter-spacing:-.02em;display:flex;align-items:center;gap:.4rem}
.nav-logo .dot{color:var(--cyan)}
.site-nav.scrolled .nav-logo{color:var(--navy)}
.nav-links{display:flex;gap:.25rem;list-style:none}
.nav-links a{font-family:var(--font-body);font-size:.88rem;font-weight:500;color:rgba(255,255,255,.8);padding:.45rem 1rem;border-radius:var(--radius-sm);transition:all .2s}
.nav-links a:hover{color:#fff;background:rgba(255,255,255,.12)}
.site-nav.scrolled .nav-links a{color:var(--gray-600)}
.site-nav.scrolled .nav-links a:hover{color:var(--blue);background:var(--blue-pale)}
.nav-cta{font-family:var(--font-body);font-size:.85rem;font-weight:600;padding:.5rem 1.2rem;background:var(--white);color:var(--navy);border-radius:var(--radius-sm);transition:all .2s;box-shadow:var(--shadow-sm)}
.nav-cta:hover{transform:translateY(-1px);box-shadow:var(--shadow-md)}
.site-nav.scrolled .nav-cta{background:var(--blue);color:#fff}
@media(max-width:768px){.nav-links,.nav-cta{display:none}}

#hero{min-height:100vh;background:var(--navy);position:relative;display:flex;align-items:center;overflow:hidden}
.hero-mesh{position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 70% 40%,rgba(29,108,240,.35) 0%,transparent 60%),radial-gradient(ellipse 50% 70% at 10% 80%,rgba(6,182,212,.2) 0%,transparent 55%),radial-gradient(ellipse 60% 40% at 90% 10%,rgba(37,99,235,.25) 0%,transparent 50%);animation:meshFloat 8s ease-in-out infinite alternate}
@keyframes meshFloat{from{transform:scale(1) rotate(0deg)}to{transform:scale(1.04) rotate(1deg)}}
.hero-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.04) 1px,transparent 1px);background-size:48px 48px}
.hero-circle{position:absolute;border-radius:50%;border:1px solid rgba(255,255,255,.06);animation:pulse 4s ease-in-out infinite}
.hero-circle.c1{width:500px;height:500px;top:-100px;right:-80px;animation-delay:0s}
.hero-circle.c2{width:300px;height:300px;top:40%;right:15%;animation-delay:1.5s}
.hero-circle.c3{width:160px;height:160px;bottom:15%;left:5%;animation-delay:3s}
@keyframes pulse{0%,100%{transform:scale(1);opacity:.5}50%{transform:scale(1.05);opacity:1}}
.hero-content{position:relative;z-index:2}
.hero-badge{display:inline-flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);padding:.4rem 1rem;border-radius:99px;font-family:var(--font-mono);font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--cyan);margin-bottom:1.5rem;backdrop-filter:blur(8px)}
.badge-dot{width:6px;height:6px;background:var(--cyan);border-radius:50%;animation:blink 1.5s ease-in-out infinite}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.3}}
.hero-name{font-family:var(--font-display);font-size:clamp(2.8rem,8vw,5.5rem);font-weight:800;line-height:1.05;letter-spacing:-.03em;color:var(--white);margin-bottom:.5rem}
.hero-name .highlight{background:linear-gradient(135deg,#60a5fa,#06b6d4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.hero-nim{font-family:var(--font-mono);font-size:.8rem;letter-spacing:.15em;color:rgba(255,255,255,.4);margin-bottom:1.5rem}
.hero-desc{font-size:1.1rem;color:rgba(255,255,255,.7);max-width:520px;margin-bottom:2.5rem;line-height:1.8}
.btn-hero-primary{display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,var(--blue),var(--blue-light));color:#fff;font-family:var(--font-body);font-size:.92rem;font-weight:600;padding:.85rem 2rem;border-radius:var(--radius-sm);border:none;cursor:pointer;transition:all .25s;box-shadow:0 4px 20px rgba(29,108,240,.4)}
.btn-hero-primary:hover{transform:translateY(-2px);box-shadow:0 8px 30px rgba(29,108,240,.5);color:#fff}
.btn-hero-outline{display:inline-flex;align-items:center;gap:.5rem;background:transparent;color:rgba(255,255,255,.85);font-family:var(--font-body);font-size:.92rem;font-weight:500;padding:.85rem 2rem;border-radius:var(--radius-sm);border:1px solid rgba(255,255,255,.2);cursor:pointer;transition:all .25s}
.btn-hero-outline:hover{background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.4);color:#fff}
.hero-stats{display:flex;gap:2rem;margin-top:3rem;padding-top:2rem;border-top:1px solid rgba(255,255,255,.08)}
.hero-stat-num{font-family:var(--font-display);font-size:2rem;font-weight:800;color:var(--white);line-height:1}
.hero-stat-num span{color:var(--cyan)}
.hero-stat-label{font-size:.78rem;color:rgba(255,255,255,.45);text-transform:uppercase;letter-spacing:.08em;margin-top:.2rem}
.hero-photo-col{position:relative;z-index:2}
.hero-photo-card{position:relative;border-radius:var(--radius-lg);overflow:hidden;background:var(--navy2);box-shadow:0 32px 80px rgba(0,0,0,.4),0 0 0 1px rgba(255,255,255,.08);aspect-ratio:3/4;max-width:340px;margin:0 2rem 0 auto}
.hero-photo-card img{width:100%;height:100%;object-fit:cover}
.hero-photo-overlay{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(10,22,40,.95) 0%,transparent 100%);padding:2rem 1.5rem 1.5rem}
.hero-photo-name{font-family:var(--font-display);font-size:1.2rem;font-weight:700;color:#fff}
.hero-photo-nim{font-family:var(--font-mono);font-size:.68rem;color:rgba(255,255,255,.5)}
.hero-photo-badge{position:absolute;top:1rem;right:1rem;background:linear-gradient(135deg,var(--blue),var(--cyan));color:#fff;font-family:var(--font-body);font-size:.7rem;font-weight:600;padding:.35rem .85rem;border-radius:99px;box-shadow:0 4px 12px rgba(29,108,240,.4)}
.hero-tech-row{display:flex;flex-wrap:wrap;gap:.5rem;margin-top:1rem}
.tech-pill-hero{font-family:var(--font-mono);font-size:.65rem;letter-spacing:.06em;padding:.3rem .75rem;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:99px;color:rgba(255,255,255,.6);transition:all .2s}
.tech-pill-hero:hover{background:rgba(29,108,240,.25);border-color:rgba(29,108,240,.5);color:var(--blue-light)}

section{padding:6rem 0}
.section-eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-family:var(--font-mono);font-size:.7rem;letter-spacing:.18em;text-transform:uppercase;color:var(--blue);margin-bottom:.75rem}
.section-eyebrow::before{content:'';display:inline-block;width:20px;height:2px;background:var(--blue);border-radius:1px}
.section-title{font-family:var(--font-display);font-size:clamp(2rem,4.5vw,2.8rem);font-weight:800;letter-spacing:-.03em;color:var(--navy);line-height:1.15;margin-bottom:1rem}
.section-desc{color:var(--text-muted);font-size:1rem;max-width:480px}

#quote-band{background:linear-gradient(135deg,var(--blue) 0%,var(--navy) 100%);padding:3rem 0;position:relative;overflow:hidden}
#quote-band::before{content:'\201C';position:absolute;font-family:var(--font-display);font-size:20rem;font-weight:800;color:rgba(255,255,255,.04);top:-3rem;left:1rem;line-height:1;pointer-events:none}
.quote-api-tag{display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);font-family:var(--font-mono);font-size:.62rem;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.7);padding:.3rem .75rem;border-radius:99px;margin-bottom:1rem}
#quote-text{font-family:var(--font-display);font-size:clamp(1.1rem,2.5vw,1.5rem);font-style:italic;font-weight:600;color:#fff;text-align:center;max-width:740px;margin:0 auto .75rem;line-height:1.5}
#quote-author{font-family:var(--font-mono);font-size:.72rem;letter-spacing:.15em;text-transform:uppercase;color:var(--cyan);text-align:center}
.btn-refresh{display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.7);font-family:var(--font-body);font-size:.78rem;font-weight:500;padding:.4rem 1rem;border-radius:99px;cursor:pointer;transition:all .2s;margin-top:1.25rem}
.btn-refresh:hover{background:rgba(255,255,255,.18);color:#fff}

#about{background:var(--white)}
.about-card{background:var(--off-white);border:1px solid var(--gray-200);border-radius:var(--radius-lg);padding:2.5rem}
.about-card p{color:var(--gray-600);margin-bottom:1rem;line-height:1.85}
.about-card p strong{color:var(--navy)}
.about-info-card{background:var(--navy);border-radius:var(--radius-lg);padding:2rem;color:#fff}
.about-info-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;margin-bottom:1.5rem;color:#fff}
.about-info-item{display:flex;justify-content:space-between;align-items:center;padding:.75rem 0;border-bottom:1px solid rgba(255,255,255,.07);font-size:.88rem}
.about-info-item:last-child{border-bottom:none}
.about-info-key{color:rgba(255,255,255,.45);font-size:.78rem;text-transform:uppercase;letter-spacing:.06em}
.about-info-val{color:#fff;font-weight:500;text-align:right}
.about-status{display:inline-flex;align-items:center;gap:.4rem;font-size:.78rem;color:#4ade80}
.status-dot{width:6px;height:6px;background:#4ade80;border-radius:50%;animation:blink 1.5s infinite}

#education{background:var(--off-white)}
.edu-timeline{position:relative;padding-left:2rem}
.edu-timeline::before{content:'';position:absolute;left:6px;top:8px;bottom:0;width:2px;background:linear-gradient(to bottom,var(--blue),var(--blue-soft),transparent);border-radius:1px}
.edu-item{position:relative;padding-bottom:2.5rem}
.edu-item:last-child{padding-bottom:0}
.edu-dot{position:absolute;left:-2rem;top:6px;width:14px;height:14px;background:var(--blue);border-radius:50%;border:2px solid var(--white);box-shadow:0 0 0 3px var(--blue-soft)}
.edu-card{background:var(--white);border:1px solid var(--gray-200);border-radius:var(--radius-md);padding:1.5rem 1.75rem;box-shadow:var(--shadow-card);transition:all .3s}
.edu-card:hover{border-color:var(--blue-light);box-shadow:var(--shadow-md);transform:translateX(4px)}
.edu-year{font-family:var(--font-mono);font-size:.68rem;letter-spacing:.1em;text-transform:uppercase;color:var(--blue);margin-bottom:.5rem}
.edu-degree{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--navy);margin-bottom:.25rem}
.edu-school{font-size:.9rem;color:var(--text-muted)}

#skills{background:var(--white)}
.skills-grid{display:grid;grid-template-columns:1fr 1fr;gap:2.5rem}
@media(max-width:576px){.skills-grid{grid-template-columns:1fr}}
.skill-group-title{font-family:var(--font-display);font-size:.85rem;font-weight:700;color:var(--navy);text-transform:uppercase;letter-spacing:.05em;margin-bottom:1.25rem;display:flex;align-items:center;gap:.5rem}
.skill-group-title i{color:var(--blue)}
.skill-item{margin-bottom:1.1rem}
.skill-head{display:flex;justify-content:space-between;margin-bottom:.45rem}
.skill-name{font-size:.9rem;font-weight:500;color:var(--gray-800)}
.skill-pct{font-family:var(--font-mono);font-size:.72rem;color:var(--blue);font-weight:600}
.skill-track{height:5px;background:var(--gray-100);border-radius:99px;overflow:hidden}
.skill-fill{height:100%;width:0;background:linear-gradient(90deg,var(--blue),var(--cyan));border-radius:99px;transition:width 1.3s cubic-bezier(.16,1,.3,1)}
.skill-fill.alt{background:linear-gradient(90deg,var(--navy),var(--blue))}
.tools-grid{display:flex;flex-wrap:wrap;gap:.5rem}
.tool-chip{display:inline-flex;align-items:center;gap:.4rem;font-family:var(--font-body);font-size:.82rem;font-weight:500;padding:.45rem 1rem;background:var(--gray-100);color:var(--gray-800);border-radius:var(--radius-sm);border:1px solid var(--gray-200);transition:all .2s}
.tool-chip:hover{background:var(--blue-pale);color:var(--blue-mid);border-color:var(--blue-soft)}

#portfolio{background:var(--off-white)}
.project-card{background:var(--white);border:1px solid var(--gray-200);border-radius:var(--radius-md);overflow:hidden;height:100%;transition:all .35s cubic-bezier(.16,1,.3,1);box-shadow:var(--shadow-card)}
.project-card:hover{border-color:var(--blue-light);box-shadow:var(--shadow-lg);transform:translateY(-6px)}
.project-img-wrap{position:relative;overflow:hidden;height:190px}
.project-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease}
.project-card:hover .project-img-wrap img{transform:scale(1.06)}
.project-img-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(10,22,40,.7) 0%,transparent 60%);opacity:0;transition:opacity .3s;display:flex;align-items:flex-end;padding:1rem}
.project-card:hover .project-img-overlay{opacity:1}
.overlay-btn{font-size:.75rem;font-weight:600;padding:.4rem .9rem;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:var(--radius-sm);backdrop-filter:blur(6px);transition:all .2s}
.overlay-btn:hover{background:var(--blue);border-color:var(--blue);color:#fff}
.project-body{padding:1.5rem}
.project-type{font-family:var(--font-mono);font-size:.62rem;letter-spacing:.15em;text-transform:uppercase;color:var(--blue);margin-bottom:.5rem}
.project-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--navy);margin-bottom:.5rem}
.project-desc{color:var(--text-muted);font-size:.86rem;margin-bottom:1rem}
.project-tech-pill{font-family:var(--font-mono);font-size:.62rem;padding:.2rem .6rem;background:var(--blue-pale);color:var(--blue-mid);border-radius:99px;border:1px solid var(--blue-soft)}
.section-sub-title{font-family:var(--font-display);font-size:1.2rem;font-weight:700;color:var(--navy);margin-bottom:1.5rem;display:flex;align-items:center;gap:.75rem}
.api-live-badge{font-family:var(--font-mono);font-size:.58rem;letter-spacing:.1em;text-transform:uppercase;padding:.2rem .6rem;background:#d1fae5;color:#065f46;border-radius:99px;border:1px solid #a7f3d0;display:inline-flex;align-items:center;gap:.3rem}
.api-live-badge::before{content:'';width:5px;height:5px;background:#10b981;border-radius:50%;animation:blink 1.5s infinite}
.repo-card{background:var(--white);border:1px solid var(--gray-200);border-radius:var(--radius-md);padding:1.25rem 1.5rem;height:100%;display:flex;flex-direction:column;transition:all .25s;box-shadow:var(--shadow-card)}
.repo-card:hover{border-color:var(--blue-light);box-shadow:var(--shadow-md)}
.repo-name{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--blue-mid);margin-bottom:.4rem;display:flex;align-items:center;gap:.4rem}
.repo-desc{font-size:.82rem;color:var(--text-muted);flex:1}
.repo-meta{display:flex;gap:1rem;margin-top:.85rem}
.repo-meta span{font-family:var(--font-mono);font-size:.68rem;color:var(--gray-400);display:flex;align-items:center;gap:.25rem}
.repo-lang-dot{width:8px;height:8px;border-radius:50%;display:inline-block}
.loading-state{text-align:center;padding:3rem;color:var(--text-muted);font-size:.88rem}

.weather-card{background:linear-gradient(135deg,var(--navy) 0%,var(--navy2) 100%);border-radius:var(--radius-lg);padding:2rem;color:#fff;display:flex;flex-wrap:wrap;align-items:center;gap:2rem;margin-top:2rem;position:relative;overflow:hidden}
.weather-card::before{content:'';position:absolute;top:-30px;right:-30px;width:180px;height:180px;background:radial-gradient(circle,rgba(6,182,212,.2) 0%,transparent 70%);border-radius:50%}
.weather-icon{font-size:3.5rem;line-height:1}
.weather-temp-big{font-family:var(--font-display);font-size:3rem;font-weight:800;color:#fff;line-height:1}
.weather-temp-big span{font-size:1.5rem;color:rgba(255,255,255,.5)}
.weather-label{font-size:.72rem;color:rgba(255,255,255,.45);text-transform:uppercase;letter-spacing:.08em;margin-bottom:.2rem}
.weather-val{font-size:.95rem;font-weight:500}
.weather-details-grid{display:flex;gap:2rem;flex-wrap:wrap}
.weather-api-note{font-family:var(--font-mono);font-size:.62rem;color:var(--cyan);letter-spacing:.08em}

#contact{background:var(--white)}
.contact-hero{background:linear-gradient(135deg,var(--navy) 0%,var(--blue) 100%);border-radius:var(--radius-lg);padding:4rem 3rem;color:#fff;text-align:center;margin-bottom:3rem;position:relative;overflow:hidden}
.contact-hero::before{content:'';position:absolute;top:-60px;left:-60px;width:300px;height:300px;background:radial-gradient(circle,rgba(255,255,255,.06) 0%,transparent 70%)}
.contact-hero::after{content:'';position:absolute;bottom:-40px;right:-40px;width:200px;height:200px;background:radial-gradient(circle,rgba(6,182,212,.15) 0%,transparent 70%)}
.contact-hero-title{font-family:var(--font-display);font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;margin-bottom:.75rem;position:relative;z-index:1}
.contact-hero-desc{color:rgba(255,255,255,.7);margin-bottom:2rem;position:relative;z-index:1}
.btn-contact{display:inline-flex;align-items:center;gap:.5rem;background:#fff;color:var(--navy);font-family:var(--font-body);font-size:.92rem;font-weight:700;padding:.85rem 2.25rem;border-radius:var(--radius-sm);transition:all .25s;position:relative;z-index:1;box-shadow:0 4px 16px rgba(0,0,0,.2)}
.btn-contact:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,.25);color:var(--navy)}
.contact-cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:1rem}
.contact-card{background:var(--off-white);border:1px solid var(--gray-200);border-radius:var(--radius-md);padding:1.5rem;display:flex;align-items:center;gap:1rem;transition:all .25s}
.contact-card:hover{border-color:var(--blue-light);background:var(--blue-pale);transform:translateY(-2px);box-shadow:var(--shadow-md)}
.contact-card-icon{width:44px;height:44px;background:linear-gradient(135deg,var(--blue),var(--blue-light));border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.1rem;flex-shrink:0}
.contact-card-label{font-size:.72rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--text-muted);margin-bottom:.15rem}
.contact-card-value{font-size:.9rem;color:var(--navy);font-weight:500;word-break:break-all}
footer{background:var(--navy);padding:2.5rem;text-align:center}
footer p{color:rgba(255,255,255,.35);font-size:.82rem;margin-bottom:.3rem}
footer span{color:var(--cyan)}
.footer-tech{display:flex;justify-content:center;flex-wrap:wrap;gap:.5rem;margin-top:1rem}
.footer-tech-pill{font-family:var(--font-mono);font-size:.6rem;letter-spacing:.08em;text-transform:uppercase;padding:.2rem .6rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:rgba(255,255,255,.4);border-radius:99px}
.fade-up{opacity:0;transform:translateY(28px);transition:opacity .65s ease,transform .65s ease}
.fade-up.visible{opacity:1;transform:translateY(0)}
.fade-left{opacity:0;transform:translateX(-28px);transition:opacity .65s ease,transform .65s ease}
.fade-left.visible{opacity:1;transform:translateX(0)}

/* Skeleton loading */
.skeleton{background:linear-gradient(90deg,#f0f0f0 25%,#e0e0e0 50%,#f0f0f0 75%);background-size:200% 100%;animation:shimmer 1.5s infinite;border-radius:4px}
@keyframes shimmer{0%{background-position:200% 0}100%{background-position:-200% 0}}
  </style>
</head>
<body>

<div style="position:fixed;top:20px;right:20px;z-index:999">
    @if(auth()->check())
        <a href="/admin" style="
            background:#1d6cf0;
            color:white;
            padding:10px 14px;
            border-radius:50%;
            text-decoration:none;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);
        ">
            <i class="bi bi-speedometer2"></i>
        </a>
    @else
        <a href="/login" style="
            background:#fff;
            color:#1d6cf0;
            padding:10px 14px;
            border-radius:50%;
            text-decoration:none;
            border:1px solid #1d6cf0;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);
        ">
            <i class="bi bi-person"></i>
        </a>
    @endif
</div>

<div id="progress-bar"></div>

<nav class="site-nav" id="navbar">
  <div class="container">
    <div class="nav-inner">
      <div class="nav-logo" id="nav-logo-text">Porto<span class="dot">.</span></div>
      <ul class="nav-links">
        <li><a href="#about">About</a></li>
        <li><a href="#education">Education</a></li>
        <li><a href="#skills">Skills</a></li>
        <li><a href="#portfolio">Portfolio</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <a href="#contact" class="nav-cta">Hire Me</a>
    </div>
  </div>
</nav>

{{-- ══ HERO ══ --}}
<section id="hero">
  <div class="hero-mesh"></div>
  <div class="hero-grid"></div>
  <div class="hero-circle c1"></div>
  <div class="hero-circle c2"></div>
  <div class="hero-circle c3"></div>

  <div class="container">
    <div class="row align-items-center gy-5 py-5" style="min-height:100vh">
      <div class="col-lg-6 hero-content">
        <div class="hero-badge">
          <span class="badge-dot"></span>
          <span id="hero-badge-text">Mahasiswa Teknik Informatika</span>
        </div>
        <h1 class="hero-name" id="hero-title">
          <span id="hero-firstname">Raihan</span><br>
          <span class="highlight" id="hero-lastname">Ramadhan</span>
        </h1>
        <p class="hero-nim" id="hero-nim-text">Loading...</p>
        <p class="hero-desc" id="hero-tagline">
          Seorang <strong style="color:#60a5fa" id="typing-role">Mahasiswa</strong>
          yang memiliki minat dalam pengembangan web.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <a href="#portfolio" class="btn-hero-primary"><i class="bi bi-grid-3x3-gap-fill"></i> Lihat Portfolio</a>
          <a href="#contact" class="btn-hero-outline"><i class="bi bi-envelope"></i> Hubungi Saya</a>
        </div>
        <div class="hero-tech-row" id="hero-tech-row">
          <span class="tech-pill-hero">HTML & CSS</span>
          <span class="tech-pill-hero">JavaScript</span>
          <span class="tech-pill-hero">Bootstrap</span>
          <span class="tech-pill-hero">PHP / Laravel</span>
          <span class="tech-pill-hero">MySQL</span>
        </div>
        <div class="hero-stats">
          <div><div class="hero-stat-num"><span id="c-projects">0</span>+</div><div class="hero-stat-label">Projects</div></div>
          <div><div class="hero-stat-num"><span id="c-skills">0</span>+</div><div class="hero-stat-label">Technologies</div></div>
          <div><div class="hero-stat-num"><span id="c-gpa">0.00</span></div><div class="hero-stat-label">IPK / 4.0</div></div>
        </div>
      </div>

      <div class="col-lg-6 hero-photo-col">
        <div class="hero-photo-card">
          <img id="hero-photo" src="{{ asset('images/placeholder.jpg') }}" alt="Foto Profil" />
          <div class="hero-photo-overlay">
            <div>
              <div class="hero-photo-name" id="photo-name">Raihan Ramadhan</div>
              <div class="hero-photo-nim" id="photo-nim">IF-11-01 · 2311102040</div>
            </div>
          </div>
          <div class="hero-photo-badge" id="photo-badge">
            <i class="bi bi-circle-fill" style="font-size:.45rem;vertical-align:middle"></i> Available
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ══ QUOTE BAND ══ --}}
<div id="quote-band">
  <div class="container text-center">
    <div class="quote-api-tag">
      <i class="bi bi-lightning-charge-fill"></i>
      Live dari Quotable.io API &nbsp;·&nbsp; AJAX (XMLHttpRequest)
    </div>
    <p id="quote-text">Memuat...</p>
    <p id="quote-author"></p>
    <button class="btn-refresh" id="btn-refresh-quote">
      <i class="bi bi-arrow-clockwise"></i> Kutipan Baru
    </button>
  </div>
</div>

{{-- ══ ABOUT ══ --}}
<section id="about">
  <div class="container">
    <div class="row gy-4 align-items-start">
      <div class="col-lg-4 fade-left">
        <div class="section-eyebrow">01 — Tentang Saya</div>
        <h2 class="section-title">Halo<br>Salam kenal</h2>
        <p class="section-desc">Kenali saya lebih dalam mulai dari latar belakang, nilai, dan apa yang mendorong saya berkarya.</p>
      </div>
      <div class="col-lg-5 fade-up">
        <div class="about-card">
          <p id="about-description">Memuat deskripsi...</p>
        </div>
      </div>
      <div class="col-lg-3 fade-up">
        <div class="about-info-card">
          <div class="about-info-title">📋 Info Singkat</div>
          <div class="about-info-item">
            <span class="about-info-key">NIM</span>
            <span class="about-info-val" id="info-nim">—</span>
          </div>
          <div class="about-info-item">
            <span class="about-info-key">Kelas</span>
            <span class="about-info-val" id="info-class">—</span>
          </div>
          <div class="about-info-item">
            <span class="about-info-key">Universitas</span>
            <span class="about-info-val" style="font-size:.78rem">Telkom University Purwokerto</span>
          </div>
          <div class="about-info-item">
            <span class="about-info-key">Status</span>
            <span class="about-info-val"><span class="about-status" id="info-status"><span class="status-dot"></span>Open to Work</span></span>
          </div>
          <div class="about-info-item">
            <span class="about-info-key">Lokasi</span>
            <span class="about-info-val" id="info-location">—</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ══ EDUCATION ══ --}}
<section id="education">
  <div class="container">
    <div class="row gy-5">
      <div class="col-lg-4 fade-left">
        <div class="section-eyebrow">02 — Pendidikan</div>
        <h2 class="section-title">Riwayat<br>Pendidikan</h2>
        <p class="section-desc">Berikut pendidikan yang pernah saya capai hingga saat ini.</p>
      </div>
      <div class="col-lg-8">
        <div class="edu-timeline" id="education-timeline">
          <div class="loading-state"><i class="bi bi-hourglass-split me-2"></i>Memuat riwayat pendidikan...</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ══ SKILLS ══ --}}
<section id="skills">
  <div class="container">
    <div class="row gy-5">
      <div class="col-lg-4 fade-left">
        <div class="section-eyebrow">03 — Skills</div>
        <h2 class="section-title">Kemampuan<br>Teknis</h2>
        <p class="section-desc">Teknologi dan tools yang saya kuasai.</p>
      </div>
      <div class="col-lg-8 fade-up" id="skills-section">
        <div class="loading-state"><i class="bi bi-hourglass-split me-2"></i>Memuat data skill via AJAX...</div>
      </div>
    </div>
  </div>
</section>

{{-- ══ PORTFOLIO ══ --}}
<section id="portfolio">
  <div class="container">
    <div class="section-eyebrow fade-up">04 — Portfolio</div>
    <h2 class="section-title fade-up">Proyek Pilihan.</h2>
    <p class="section-desc mb-5 fade-up">Projek yang saya buat selama ini.</p>

    <div class="row g-4 mb-5" id="projects-container">
      <div class="loading-state col-12"><i class="bi bi-hourglass-split me-2"></i>Memuat proyek via AJAX...</div>
    </div>

    {{-- GitHub Repos --}}
    <div id="github-section" class="fade-up">
      <div class="section-sub-title">
        <i class="bi bi-github"></i>
        Repository GitHub
        <span class="api-live-badge">GitHub API</span>
      </div>
      <div class="loading-state" id="repos-loading">
        <i class="bi bi-hourglass-split me-2"></i>Mengambil data dari GitHub API via AJAX...
      </div>
      <div class="row g-3" id="repos-container"></div>
    </div>
  </div>
</section>

{{-- ══ CONTACT ══ --}}
<section id="contact">
  <div class="container">
    <div class="section-eyebrow fade-up">05 — Contact</div>
    <h2 class="section-title fade-up">Hubungi Saya</h2>

    <div class="contact-hero fade-up">
      <h3 class="contact-hero-title">Ada proyek menarik?<br>Saya siap membantu! 🚀</h3>
      <p class="contact-hero-desc">Terbuka untuk peluang magang, proyek freelance, kolaborasi open-source, dan diskusi teknologi.</p>
      <a href="#" class="btn-contact" id="btn-email-contact">
        <i class="bi bi-envelope-fill"></i> Kirim Email Sekarang
      </a>
    </div>

    {{-- Weather --}}
    <div class="fade-up mb-4">
      <div class="section-sub-title" style="font-size:1rem;margin-bottom:.75rem">
        <i class="bi bi-cloud-sun"></i> Cuaca Purwokerto Hari Ini
        <span class="api-live-badge">Open-Meteo API</span>
      </div>
      <div class="weather-card" id="weather-widget">
        <p style="color:rgba(255,255,255,.5);font-size:.85rem"><i class="bi bi-hourglass-split me-1"></i>Mengambil data cuaca via AJAX...</p>
      </div>
    </div>

    <div class="contact-cards fade-up" id="contact-cards">
      <div class="contact-card">
        <div class="contact-card-icon"><i class="bi bi-envelope-fill"></i></div>
        <div><div class="contact-card-label">Email</div><div class="contact-card-value" id="contact-email">—</div></div>
      </div>
      <div class="contact-card">
        <div class="contact-card-icon"><i class="bi bi-github"></i></div>
        <div><div class="contact-card-label">GitHub</div><div class="contact-card-value" id="contact-github">—</div></div>
      </div>
      <div class="contact-card">
        <div class="contact-card-icon"><i class="bi bi-instagram"></i></div>
        <div><div class="contact-card-label">Instagram</div><div class="contact-card-value" id="contact-ig">—</div></div>
      </div>
      <div class="contact-card">
        <div class="contact-card-icon"><i class="bi bi-geo-alt-fill"></i></div>
        <div><div class="contact-card-label">Lokasi</div><div class="contact-card-value" id="contact-location">—</div></div>
      </div>
    </div>
  </div>
</section>

<footer>
  <p>Dibuat oleh <span id="footer-name">Raihan Ramadhan</span> &nbsp;·&nbsp; NIM <span id="footer-nim">2311102040</span> &nbsp;·&nbsp; Teknik Informatika Telkom University Purwokerto &nbsp;·&nbsp; 2026</p>
  <div class="footer-tech">
    <span class="footer-tech-pill">Laravel 11</span>
    <span class="footer-tech-pill">Blade Template</span>
    <span class="footer-tech-pill">Bootstrap 5</span>
    <span class="footer-tech-pill">JavaScript Native</span>
    <span class="footer-tech-pill">AJAX · XMLHttpRequest</span>
    <span class="footer-tech-pill">Quotable.io API</span>
    <span class="footer-tech-pill">GitHub REST API</span>
    <span class="footer-tech-pill">Open-Meteo API</span>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ════════════════════════════════════════════════════════════════
//  PORTFOLIO JS — All AJAX via XMLHttpRequest
//  API Endpoints (Laravel):
//    GET /api/profile    → profile data
//    GET /api/skills     → skills grouped by category
//    GET /api/projects   → projects list
//    GET /api/education  → education list
// ════════════════════════════════════════════════════════════════

var CSRF = document.querySelector('meta[name="csrf-token"]').content;

// ── 1. NAVBAR & PROGRESS BAR ─────────────────────────────────
var navbar = document.getElementById('navbar');
var progressBar = document.getElementById('progress-bar');
window.addEventListener('scroll', function () {
  navbar.classList.toggle('scrolled', window.scrollY > 50);
  var pct = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight) * 100;
  progressBar.style.width = pct + '%';
});

// ── 2. TYPING EFFECT ────────────────────────────────────────
var roles = ['Frontend Developer', 'UI / UX Enthusiast', 'Web Developer'];
var roleEl = document.getElementById('typing-role');
var rIdx = 0, cIdx = 0, del = false;
function typeEffect() {
  if (!roleEl) return;
  var cur = roles[rIdx];
  if (!del) { roleEl.textContent = cur.slice(0, ++cIdx); if (cIdx === cur.length) { del = true; setTimeout(typeEffect, 1800); return; } }
  else { roleEl.textContent = cur.slice(0, --cIdx); if (cIdx === 0) { del = false; rIdx = (rIdx + 1) % roles.length; } }
  setTimeout(typeEffect, del ? 55 : 90);
}
typeEffect();

// ── 3. SCROLL ANIMATIONS ────────────────────────────────────
var animEls = document.querySelectorAll('.fade-up, .fade-left');
var animObs = new IntersectionObserver(function (entries) {
  entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('visible'); animObs.unobserve(e.target); } });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
animEls.forEach(function (el) { animObs.observe(el); });

// ── 4. COUNTER ANIMATION ────────────────────────────────────
function runCounter(el, target, isFloat) {
  var start = performance.now(), dur = 1800;
  function frame(now) {
    var p = Math.min((now - start) / dur, 1), ease = 1 - Math.pow(1 - p, 3), val = ease * target;
    el.textContent = isFloat ? val.toFixed(2) : Math.round(val);
    if (p < 1) requestAnimationFrame(frame); else el.textContent = isFloat ? target.toFixed(2) : target;
  }
  requestAnimationFrame(frame);
}

// ════════════════════════════════════════════════════════════════
//  AJAX #1 — PROFILE (Laravel API)
// ════════════════════════════════════════════════════════════════
function fetchProfile() {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '/api/profile', true);
  xhr.setRequestHeader('Accept', 'application/json');
  xhr.onreadystatechange = function () {
    if (xhr.readyState !== 4) return;
    if (xhr.status === 200) {
      try {
        var res = JSON.parse(xhr.responseText);
        if (!res.success) return;
        var p = res.data;

        // Navbar
        var logoEl = document.getElementById('nav-logo-text');
        if (logoEl) logoEl.innerHTML = 'Porto ' + p.name.split(' ')[0] + '<span class="dot">.</span>';

        // Hero
        var parts = p.name.trim().split(' ');
        document.getElementById('hero-firstname').textContent = parts[0] || '';
        document.getElementById('hero-lastname').textContent  = parts.slice(1).join(' ') || '';
        document.getElementById('hero-nim-text').textContent  = p.nim + ' / ' + p['class'];
        document.getElementById('hero-badge-text').textContent = p.tagline || 'Mahasiswa Teknik Informatika';

        // Photo
        if (p.photo) document.getElementById('hero-photo').src = '/storage/' + p.photo;
        document.getElementById('photo-name').textContent = p.name;
        document.getElementById('photo-nim').textContent  = p['class'] + ' · ' + p.nim;

        if (!p.available) {
          var badge = document.getElementById('photo-badge');
          if (badge) { badge.style.background = '#64748b'; badge.innerHTML = '<i class="bi bi-circle" style="font-size:.45rem;vertical-align:middle"></i> Not Available'; }
        }

        // About
        document.getElementById('about-description').textContent = p.description;
        document.getElementById('info-nim').textContent      = p.nim;
        document.getElementById('info-class').textContent    = p['class'];
        document.getElementById('info-location').textContent = p.location || '—';
        if (!p.available) {
          var st = document.getElementById('info-status');
          if (st) st.innerHTML = '<span class="status-dot" style="background:#f59e0b"></span><span style="color:#f59e0b">Not Available</span>';
        }

        // Contact
        if (p.email) {
          document.getElementById('contact-email').textContent = p.email;
          document.getElementById('btn-email-contact').href = 'mailto:' + p.email;
        }
        if (p.github) document.getElementById('contact-github').textContent = 'github.com/' + p.github;
        if (p.instagram) document.getElementById('contact-ig').textContent = '@' + p.instagram;
        document.getElementById('contact-location').textContent = p.location || '—';

        // Footer
        document.getElementById('footer-name').textContent = p.name;
        document.getElementById('footer-nim').textContent  = p.nim;

        // Counters
        var statsEl = document.querySelector('.hero-stats');
        if (statsEl) {
          var statsObs = new IntersectionObserver(function (entries) {
            if (entries[0].isIntersecting) {
              runCounter(document.getElementById('c-projects'), parseInt(p.projects_count) || 0, false);
              runCounter(document.getElementById('c-skills'),   parseInt(p.tech_count) || 0, false);
              runCounter(document.getElementById('c-gpa'),      parseFloat(p.gpa) || 0, true);
              statsObs.disconnect();
            }
          }, { threshold: 0.6 });
          statsObs.observe(statsEl);
        }
      } catch (e) { console.error('Profile parse error', e); }
    }
  };
  xhr.send();
}
fetchProfile();

// ════════════════════════════════════════════════════════════════
//  AJAX #2 — EDUCATION (Laravel API)
// ════════════════════════════════════════════════════════════════
function fetchEducation() {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '/api/education', true);
  xhr.setRequestHeader('Accept', 'application/json');
  xhr.onreadystatechange = function () {
    if (xhr.readyState !== 4) return;
    var el = document.getElementById('education-timeline');
    if (!el) return;
    if (xhr.status === 200) {
      try {
        var res = JSON.parse(xhr.responseText);
        if (!res.success || !res.data.length) { el.innerHTML = '<p class="text-muted">Belum ada data pendidikan.</p>'; return; }
        el.innerHTML = '';
        res.data.forEach(function (edu) {
          var item = document.createElement('div');
          item.className = 'edu-item fade-up';
          item.innerHTML =
            '<div class="edu-dot"></div>' +
            '<div class="edu-card">' +
              '<div class="edu-year">' + esc(edu.year_start) + ' — ' + esc(edu.year_end || 'Sekarang') + '</div>' +
              '<div class="edu-degree">' + esc(edu.degree) + '</div>' +
              '<div class="edu-school">' + esc(edu.school) + '</div>' +
            '</div>';
          el.appendChild(item);
          animObs.observe(item);
        });
      } catch (e) { el.innerHTML = '<p class="text-muted">Gagal memuat data.</p>'; }
    } else { el.innerHTML = '<p class="text-muted">Gagal terhubung ke server.</p>'; }
  };
  xhr.send();
}
fetchEducation();

// ════════════════════════════════════════════════════════════════
//  AJAX #3 — SKILLS (Laravel API)
// ════════════════════════════════════════════════════════════════
function fetchSkills() {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '/api/skills', true);
  xhr.setRequestHeader('Accept', 'application/json');
  xhr.onreadystatechange = function () {
    if (xhr.readyState !== 4) return;
    var el = document.getElementById('skills-section');
    if (!el) return;
    if (xhr.status === 200) {
      try {
        var res = JSON.parse(xhr.responseText);
        var cats = res.data;
        var catLabels = { frontend: { label: 'Frontend', icon: 'bi-window-desktop' }, backend: { label: 'Backend', icon: 'bi-server' } };
        var html = '<div class="skills-grid">';
        ['frontend', 'backend'].forEach(function (cat) {
          if (!cats[cat]) return;
          var info = catLabels[cat];
          html += '<div><div class="skill-group-title"><i class="bi ' + info.icon + '"></i> ' + info.label + '</div>';
          cats[cat].forEach(function (s) {
            var altClass = cat === 'backend' ? ' alt' : '';
            html +=
              '<div class="skill-item">' +
              '<div class="skill-head"><span class="skill-name">' + esc(s.name) + '</span><span class="skill-pct">' + s.percentage + '%</span></div>' +
              '<div class="skill-track"><div class="skill-fill' + altClass + '" data-pct="' + s.percentage + '"></div></div>' +
              '</div>';
          });
          html += '</div>';
        });
        html += '</div>';

        // Tools
        if (cats.tools) {
          html += '<div class="mt-4"><div class="skill-group-title"><i class="bi bi-tools"></i> Tools &amp; Ekosistem</div><div class="tools-grid">';
          cats.tools.forEach(function (s) {
            html += '<span class="tool-chip"><i class="bi ' + (s.icon || 'bi-gear') + '"></i> ' + esc(s.name) + '</span>';
          });
          html += '</div></div>';
        }
        el.innerHTML = html;

        // Animate skill bars
        var fills = el.querySelectorAll('.skill-fill');
        var sObs = new IntersectionObserver(function (entries) {
          entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.style.width = e.target.getAttribute('data-pct') + '%'; sObs.unobserve(e.target); }
          });
        }, { threshold: 0.4 });
        fills.forEach(function (f) { sObs.observe(f); });
      } catch (e) { el.innerHTML = '<p class="text-muted">Gagal memuat skill.</p>'; }
    }
  };
  xhr.send();
}
fetchSkills();

// ════════════════════════════════════════════════════════════════
//  AJAX #4 — PROJECTS (Laravel API)
// ════════════════════════════════════════════════════════════════
function fetchProjects() {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '/api/projects', true);
  xhr.setRequestHeader('Accept', 'application/json');
  xhr.onreadystatechange = function () {
    if (xhr.readyState !== 4) return;
    var el = document.getElementById('projects-container');
    if (!el) return;
    if (xhr.status === 200) {
      try {
        var res = JSON.parse(xhr.responseText);
        if (!res.success || !res.data.length) { el.innerHTML = '<p class="text-muted col-12">Belum ada proyek.</p>'; return; }
        el.innerHTML = '';
        res.data.forEach(function (proj) {
          var techArr = proj.tech_array || (proj.tech_stack ? proj.tech_stack.split(',') : []);
          var techPills = techArr.map(function (t) { return '<span class="project-tech-pill">' + esc(t.trim()) + '</span>'; }).join('');
          var col = document.createElement('div');
          col.className = 'col-md-6 col-lg-4 fade-up';
          col.innerHTML =
            '<div class="project-card">' +
            '<div class="project-img-wrap">' +
              '<img src="' + esc(proj.image_url) + '" alt="' + esc(proj.title) + '" onerror="this.src=\'https://placehold.co/600x400/0a1628/3b82f6?text=Project\'">' +
              '<div class="project-img-overlay"><div class="d-flex gap-2">' +
                (proj.github_url ? '<a href="' + esc(proj.github_url) + '" target="_blank" class="overlay-btn"><i class="bi bi-github"></i> Source</a>' : '') +
                (proj.demo_url ? '<a href="' + esc(proj.demo_url) + '" target="_blank" class="overlay-btn"><i class="bi bi-box-arrow-up-right"></i> Demo</a>' : '') +
              '</div></div>' +
            '</div>' +
            '<div class="project-body">' +
              '<div class="project-type">' + esc(proj.type || 'Web Application') + '</div>' +
              '<div class="project-title">' + esc(proj.title) + '</div>' +
              '<p class="project-desc">' + esc(proj.description) + '</p>' +
              '<div class="d-flex flex-wrap gap-1">' + techPills + '</div>' +
            '</div></div>';
          el.appendChild(col);
          animObs.observe(col);
        });
      } catch (e) { el.innerHTML = '<p class="text-muted col-12">Gagal memuat proyek.</p>'; }
    }
  };
  xhr.send();
}
fetchProjects();

// ════════════════════════════════════════════════════════════════
//  AJAX #5 — QUOTABLE.IO (External API)
// ════════════════════════════════════════════════════════════════
function fetchQuote() {
  var textEl = document.getElementById('quote-text'), authorEl = document.getElementById('quote-author');
  if (textEl) textEl.innerHTML = '<span style="opacity:.5;font-size:.85rem">Memuat kutipan...</span>';
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'https://api.quotable.io/random?tags=technology,success,wisdom', true);
  xhr.timeout = 7000;
  xhr.onreadystatechange = function () {
    if (xhr.readyState !== 4) return;
    if (xhr.status === 200) {
      try { var d = JSON.parse(xhr.responseText); textEl.textContent = '\u201c' + d.content + '\u201d'; authorEl.textContent = '\u2014 ' + d.author; }
      catch (e) { fallbackQuote(textEl, authorEl); }
    } else { fallbackQuote(textEl, authorEl); }
  };
  xhr.ontimeout = function () { fallbackQuote(textEl, authorEl); };
  xhr.send();
}
function fallbackQuote(t, a) {
  var list = [{q:"The best way to predict the future is to invent it.",a:"Alan Kay"},{q:"Simplicity is the soul of efficiency.",a:"Austin Freeman"},{q:"Code is like humor. When you have to explain it, it's bad.",a:"Cory House"},{q:"First, solve the problem. Then, write the code.",a:"John Johnson"}];
  var pick = list[Math.floor(Math.random() * list.length)];
  t.textContent = '\u201c' + pick.q + '\u201d'; a.textContent = '\u2014 ' + pick.a;
}
document.getElementById('btn-refresh-quote').addEventListener('click', fetchQuote);
fetchQuote();

// ════════════════════════════════════════════════════════════════
//  AJAX #6 — GITHUB REST API (External)
// ════════════════════════════════════════════════════════════════
function fetchGithubRepos() {
  var GH_USER = 'raicd';
  var loadingEl = document.getElementById('repos-loading'), containerEl = document.getElementById('repos-container');
  var langColors = {JavaScript:'#f7df1e',TypeScript:'#3178c6',Python:'#3572a5',PHP:'#4f5d95',Java:'#b07219','C++':'#f34b7d',C:'#555',Go:'#00add8',Rust:'#dea584',HTML:'#e34c26',CSS:'#563d7c'};
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'https://api.github.com/users/' + GH_USER + '/repos?sort=updated&per_page=6&type=public', true);
  xhr.setRequestHeader('Accept', 'application/vnd.github.v3+json');
  xhr.timeout = 10000;
  xhr.onreadystatechange = function () {
    if (xhr.readyState !== 4) return;
    if (xhr.status === 200) {
      try {
        var repos = JSON.parse(xhr.responseText);
        if (loadingEl) loadingEl.style.display = 'none';
        repos.forEach(function (repo) {
          var lang = repo.language || 'Unknown', color = langColors[lang] || '#94a3b8';
          var col = document.createElement('div'); col.className = 'col-md-6 col-lg-4';
          col.innerHTML = '<div class="repo-card">' +
            '<div class="repo-name"><i class="bi bi-folder" style="color:var(--blue)"></i>' + esc(repo.name) + '</div>' +
            '<div class="repo-desc">' + esc(repo.description || 'Tidak ada deskripsi.') + '</div>' +
            '<div class="repo-meta"><span><span class="repo-lang-dot" style="background:' + color + '"></span>' + esc(lang) + '</span>' +
            '<span><i class="bi bi-star"></i> ' + repo.stargazers_count + '</span><span><i class="bi bi-diagram-2"></i> ' + repo.forks_count + '</span></div>' +
            '<a href="' + repo.html_url + '" target="_blank" rel="noopener" style="display:inline-flex;align-items:center;gap:.3rem;margin-top:.85rem;font-size:.75rem;font-weight:600;color:var(--blue-mid)"><i class="bi bi-box-arrow-up-right"></i> Buka Repository</a>' +
            '</div>';
          containerEl.appendChild(col);
        });
      } catch (e) { if (loadingEl) loadingEl.textContent = 'Gagal memproses data GitHub.'; }
    } else if (xhr.status === 403) { if (loadingEl) loadingEl.textContent = '⚠️ Rate limit GitHub API. Coba lagi nanti.'; }
    else if (xhr.status === 404) { if (loadingEl) loadingEl.textContent = '⚠️ Username GitHub tidak ditemukan.'; }
    else { if (loadingEl) loadingEl.textContent = '⚠️ Gagal terhubung (status ' + xhr.status + ')'; }
  };
  xhr.ontimeout = function () { if (loadingEl) loadingEl.textContent = 'Timeout — periksa koneksi.'; };
  xhr.send();
}
fetchGithubRepos();

// ════════════════════════════════════════════════════════════════
//  AJAX #7 — OPEN-METEO WEATHER (External)
// ════════════════════════════════════════════════════════════════
function fetchWeather() {
  var widgetEl = document.getElementById('weather-widget');
  var url = 'https://api.open-meteo.com/v1/forecast?latitude=-7.4244&longitude=109.2317&current_weather=true&timezone=Asia%2FJakarta';
  var xhr = new XMLHttpRequest();
  xhr.open('GET', url, true); xhr.timeout = 8000;
  xhr.onreadystatechange = function () {
    if (xhr.readyState !== 4 || !widgetEl) return;
    if (xhr.status === 200) {
      try {
        var data = JSON.parse(xhr.responseText), cw = data.current_weather;
        var desc = getWmoDesc(cw.weathercode), dir = getWindDir(cw.winddirection);
        widgetEl.innerHTML =
          '<div class="weather-icon">' + desc.icon + '</div>' +
          '<div><div class="weather-temp-big">' + cw.temperature + '<span>°C</span></div><div class="weather-label">Suhu Sekarang</div></div>' +
          '<div class="weather-details-grid">' +
            '<div><div class="weather-label">Kondisi</div><div class="weather-val">' + desc.text + '</div></div>' +
            '<div><div class="weather-label">Kecepatan Angin</div><div class="weather-val">' + cw.windspeed + ' km/h</div></div>' +
            '<div><div class="weather-label">Arah Angin</div><div class="weather-val">' + dir + '</div></div>' +
          '</div>' +
          '<div style="margin-left:auto;align-self:flex-end"><div class="weather-label">Sumber Data</div><div class="weather-api-note">Open-Meteo API · AJAX</div><div style="color:rgba(255,255,255,.35);font-size:.7rem;margin-top:.2rem">📍 Purwokerto, Jateng</div></div>';
      } catch (e) { widgetEl.innerHTML = '<p style="color:rgba(255,255,255,.5)">Gagal memproses data cuaca.</p>'; }
    } else { widgetEl.innerHTML = '<p style="color:rgba(255,255,255,.5)">Gagal memuat cuaca.</p>'; }
  };
  xhr.ontimeout = function () { if (widgetEl) widgetEl.innerHTML = '<p style="color:rgba(255,255,255,.5)">Timeout cuaca.</p>'; };
  xhr.send();
}
function getWmoDesc(c) {
  var m = {0:{icon:'☀️',text:'Cerah'},1:{icon:'🌤️',text:'Cerah Berawan'},2:{icon:'⛅',text:'Sebagian Berawan'},3:{icon:'☁️',text:'Mendung'},45:{icon:'🌫️',text:'Berkabut'},51:{icon:'🌦️',text:'Gerimis'},61:{icon:'🌧️',text:'Hujan Ringan'},63:{icon:'🌧️',text:'Hujan Sedang'},65:{icon:'🌧️',text:'Hujan Deras'},80:{icon:'🌦️',text:'Hujan Lokal'},95:{icon:'⛈️',text:'Badai Petir'},99:{icon:'⛈️',text:'Badai + Hujan Es'}};
  return m[c] || {icon:'🌡️',text:'Kode '+c};
}
function getWindDir(d) { return ['Utara','Timur Laut','Timur','Tenggara','Selatan','Barat Daya','Barat','Barat Laut'][Math.round(d/45)%8]; }
fetchWeather();

// ── HELPER ─────────────────────────────────────────────────
function esc(s) { if (!s) return ''; return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }
</script>
</body>
</html>