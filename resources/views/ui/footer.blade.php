
<link href={{asset('css\ui\footer.css')}} rel="stylesheet">

<div class="website-map">
    <p class="footer-title">Website Map</p>
    <div class="footer-section">
        <div class="map-section">
            <div class="map-section-title">Follow Us</div>
            <ul class="links">
                <a href="https://www.tiktok.com/@alatganti_aircond_ahseng" class="link" data-content="tiktok">
                    <i class="fa-brands fa-tiktok"></i>
                    <li>TikTok</li>
                </a>
                <a href="https://www.facebook.com/FrozenForAlatGanti" class="link" data-content="facebook">
                    <i class="fa-brands fa-facebook"></i>
                    <li>Facebook</li>
                </a>
                <a href="https://youtube.com/@frozenaircondsdnbhd8042" class="link" data-content="youtube">
                    <i class="fa-brands fa-youtube"></i>
                    <li>Youtube</li>
                </a>
                <a href="https://www.wasap.my/60172430100" class="link" data-content="whatapps">
                    <i class="fa-brands fa-whatsapp"></i>
                    <li>Whatapps</li>
                </a>
            </ul>
        </div>

        <hr>

        <div class="map-section">
            <div class="map-section-title">Pages</div>
            <ul class="links">
                <a href={{route('frontend.index')}} class="link">
                    <i class="fa-solid fa-house"></i>
                    <li>Home</li>
                </a>
                <a href={{route('frontend.about')}} class="link">
                    <i class="fa-solid fa-address-card"></i>
                    <li>About Us</li>
                </a>
                <a href={{route('frontend.type')}} class="link">
                    <i class="fa-brands fa-product-hunt"></i>
                    <li>Product</li>
                </a>
                <a href={{route('frontend.contact')}} class="link">
                    <i class="fa-solid fa-circle-info"></i>
                    <li>Content Us</li>
                </a>
            </ul>
        </div>
        <hr>
        <div class="map-section">
            <ul class="links">
                <li class="address">
                    <p class="company-name">Frozen Air Cond Sdn Bhd</p>
                    <i class="fa-solid fa-location-dot"></i>
                    No.5 ,Jalan Emas 5,<br>
                    Taman Emas, Hulu Yam, <br>
                    44300 Hulu Yam, Selangor.
                </li>
                <li class="phone">
                    <i class="fa-solid fa-phone"></i>
                    +6017 2430 100
                </li>
            </ul>
        </div>
        <div class="map-section">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.5705456242517!2d101.63097927259881!3d3.45405444353573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc6d8d2f518695%3A0xc1c2470ad30300fe!2sFrozen%20air%20cond%20sdn%20bhd!5e0!3m2!1sen!2smy!4v1688700665979!5m2!1sen!2smy" width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <div class="copyright">
        <p>© 2023{{ date('Y') != 2023 ? ' - '. date('Y') : '' }}. All rights reserved. Copyright owned by Frozen Air Cond Sdn Bhd. All servers.</p>
        <p>Empowering by <a class="author" href="https://gansoonlee.github.io" target="_new">Frank Gan</a></p>
    </div>
</div>