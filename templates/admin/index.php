<?php
    use Mobjaan\Base\Constants;
?>
<div id="personalinfo">
        <div class="card">
            <div class="photo" style="background-image: url(<?php echo Constants::getPluginURL() . 'assets/imgs/developer.jpeg' ?>)"></div>
            <div class="content">
                <div class="intro">
                    <span class="greets">Hello there...</span>
                    <span class="name"><span>I'm </span><b> Abdul Rehman</b></span>
                    <span class="tagline">Developer of the <b>Mobjaan</b> plugin.</span>
                </div>
                <hr />
                <div class="tabular">
                    <div class="wrapper">
                        <div class="row">
                            <b>Age</b>
                            <span id="mobjaan_developer_age">18</span>
                        </div>
                        <div class="row">
                            <b>CNIC</b>
                            <span>34101-4422637-7</span>
                        </div>
                        <div class="row">
                            <b>Email</b>
                            <span>
                                <a href="mailto:mehars.6925@gmail.com">mehars.6925@gmail.com</a>
                            </span>
                        </div>
                        <div class="row">
                            <b>Phone</b>
                            <span>
                                <a href="tel:+923167943024">+92 316 7943024</a>
                            </span>
                        </div>
                        <div class="row">
                            <b>Address</b>
                            <span>Gujranwala, Pakistan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="links">
                <a href="https://github.com/AbdulRehmanMehar" class="link" target="_blank">
                    <i class="fab fa-lg fa-github"></i>
                </a>
                <a href="https://www.linkedin.com/in/mehar6925/" class="link" target="_blank">
                    <i class="fab fa-lg fa-linkedin"></i>
                </a>
                <a href="https://www.fiverr.com/abdulrehmanmeh" class="link" target="_blank" style="margin-top: -20px; margin-bottom: -10px;">
                    <i class="img" style="background-image: url('https://www.fiverr.com/favicon.ico')"></i>
                </a>
                <a href="https://www.upwork.com/freelancers/~010d76b8839f89f4a3" class="link" target="_blank" style="margin-top: -20px; margin-bottom: -10px;">
                    <i class="img" style="background-image: url('https://www.upwork.com/favicon.ico')"></i>
                </a>
            </div>
        </div>
</div>

<style>
    #wpcontent,#wpfooter {
        color: #f7f7f7 !important;
        background-color: #3c3c3c !important;
    }
    ul#adminmenu a.wp-has-current-submenu:after, ul#adminmenu>li.current>a.current:after {
        border-right-color: #3c3c3c !important;
    }
</style>

<script>
    (function() {
        function calculateAge (birthDate) {
            birthDate = new Date(birthDate);
            otherDate = new Date();

            var years = (otherDate.getFullYear() - birthDate.getFullYear());

            if (otherDate.getMonth() < birthDate.getMonth() || 
                otherDate.getMonth() == birthDate.getMonth() && otherDate.getDate() < birthDate.getDate()) {
                years--;
            }

            return years;
        }

        document.getElementById('mobjaan_developer_age').innerHTML = calculateAge("11/11/2000", );
    })();
</script>