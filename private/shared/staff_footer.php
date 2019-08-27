
</body>
<footer class="section footer-classic context-dark bg-image" style="background: #2d3246; padding-top:20px; color: white;">
    <div class="container">
        <div class="row row-30">
            <div class="col-md-4 col-xl-5">
                <div class="pr-xl-4"><a class="brand" href="index.html"></a>
                    <!-- Rights-->
                    <p class="rights"><span>©  </span><span class="copyright-year">2019</span><span> </span><span>Lab Project</span><span>. </span><span>A K M Naharul Hayat, Eugene Fong, Houssam Zeitoun, Kirill Zasimov and Samuel Paget</span></p>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Contacts</h5>
                <dl class="contact-list">
                    <dt>Address:</dt>
                    <dd>12 Britten Court London</dd>
                </dl>
                <dl class="contact-list">
                    <dt>email:</dt>
                    <dd><a href="mailto:#">K1764014@kcl.ac.uk</a></dd>
                </dl>
                <dl class="contact-list">
                    <dt>phones:</dt>
                    <dd><a href="tel:#">+4407518850169</a> <span>or</span> <a href="tel:#">+91 9571195353</a>
                    </dd>
                </dl>
            </div>
            <div class="col-md-4 col-xl-3">
                <h5>Links</h5>
                <ul class="nav-list">
                    <li><a href="<?php echo urlFor('/staff_area/pages/rental_pages/rental_browse.php'); ?>">Rentals</a></li>
                    <li><a href="<?php echo urlFor('/staff_area/pages/member_pages/members_browse.php'); ?>">Members</a></li>
                </ul>
            </div>
        </div>
    </div>

</footer>

</html>

<?php
db_disconnect($db);
?>
