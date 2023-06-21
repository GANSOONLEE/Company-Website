
<link href={{asset('css\ui\footer.css')}} rel="stylesheet">

<div class="website-map">
    <div class="footer-section">
        <div class="map-section">
            <div class="map-section-title">Contact Us</div>
            <ul class="links">
                <a href="https://www.tiktok.com/@alatganti_aircond_ahseng" class="link" data-content="tiktok">
                    <li>TikTok</li>
                </a>
                <a href="https://www.facebook.com/FrozenForAlatGanti" class="link" data-content="facebook">
                    <li>Facebook</li>
                </a>
                <a href="https://youtube.com/@frozenaircondsdnbhd8042" class="link" data-content="youtube">
                    <li>Youtube</li>
                </a>
                <a href="https://www.wasap.my/60172430100" class="link" data-content="whatapps">
                    <li>Whatapps</li>
                </a>
            </ul>
        </div>

        <div class="map-section">
            <div class="map-section-title">Pages</div>
            <ul class="links">
                <a href={{route('frontend.index')}} class="link">
                    <li>Home</li>
                </a>
                <a href={{route('frontend.about')}} class="link">
                    <li>About Us</li>
                </a>
                <a href={{route('frontend.type')}} class="link">
                    <li>Product</li>
                </a>
                <a href={{route('frontend.contact')}} class="link">
                    <li>Content Us</li>
                </a>
            </ul>
        </div>

        <div class="map-section">
            <div class="map-section-title">Info</div>
            <ul class="links">
                {{-- <li>Whatapps</li> --}}
                {{-- <li>Email</li> --}}
                <li>
                    <b style="font-size:2rem">Frozen Air Cond Sdn Bhd</b><br>
                    No.5 ,Jalan Emas 5,<br>
                    Taman Emas, Hulu Yam, <br>
                    44300 Hulu Yam, Selangor.
                </li>
                <li>+6017 2430 100</li>
            </ul>
        </div>
    </div>
    <div class="copyright">© 2023{{ date('Y') != 2023 ? ' - '. date('Y') : '' }}. All rights reserved. Copyright owned by Frozen Air Cond Sdn Bhd. All servers.</div>
</div>