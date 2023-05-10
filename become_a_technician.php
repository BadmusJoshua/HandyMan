<?php include 'inc/header/header.php';

?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item d-block d-md-none">
            <button class="btn btn-primary"> <a href="become_a_technician.php" class="text-decoration-none text-light"> Become a Technician</a> </button>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="profile.php">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="meetings.php">
                <i class="ri-building-4-line"></i>
                <span>Meetings</span>
            </a>
        </li><!-- End Meeting Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="faq.php">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="contact.php">
                <i class="bi bi-envelope"></i>
                <span>Help Desk</span>
            </a>
        </li><!-- End Contact Page Nav -->



        <li class="nav-item">
            <a class="nav-link collapsed" href="suggestionin.php">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Sign Out</span>
            </a>
        </li><!-- End suggestionin Page Nav -->
    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Upgrade to Technician</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Upgrade</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column  justify-content-center py-4">
            <!-- <div class="container"> -->
            <div class="row justify-content-center m-0 p-0">
                <div class="col-lg-8 col-md-6 d-flex flex-column  justify-content-center">

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Technician Information</h5>
                                <p class="text-center small">Enter details to setup technician account</p>
                            </div>

                            <form class="row g-3 needs-validation" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" novalidate>

                                <div class="col-12">
                                    <label for="yourJob" class="form-label">Job</label>
                                    <input type="text" name="job" class="form-control" id="yourJob" value="<?= $job ?>" required>
                                    <div class="invalid-feedback">Please, enter the service you want to offer</div>
                                </div>

                                <div class="col-12">
                                    <label for="About" class="form-label">About</label>
                                    <textarea name="about" id="" cols="10" rows="2" class="form-control" placeholder="Enter a little description about your services" resizable="false" value="<?= $about ?>" required></textarea>
                                </div>

                                <div class="col-12">
                                    <label for="yourCompany" class="form-label">Company</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="company" class="form-control" id="yourCompany" value="<?= $company ?>" required>
                                        <div class="invalid-feedback">Please enter your company name.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="Address" class="form-label">Address</label>
                                    <textarea name="address" id="" cols="10" rows="2" class="form-control" placeholder="Enter your company's address" resizable="false" value="<?= $address ?>" required></textarea>
                                </div>

                                <div class="col-12">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control" id="yourCountry" value="<?= $country ?>" required>
                                    <div class="invalid-feedback">Please enter the name of your country.</div>

                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                                        <div class="invalid-feedback">You must agree before submitting.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" name="submit" type="submit">Upgrade Account</button>
                                </div>

                            </form>
                            <!--  -->
                        </div>
                    </div>

                </div>
            </div>
            <!-- </div> -->

        </section>

    </div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</main>
<?php include 'inc/footer/footer.php'; ?>