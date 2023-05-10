 <?php
  include 'inc/header/header.php';
  ?>
 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

   <ul class="sidebar-nav" id="sidebar-nav">

     <li class="nav-item">
       <?php
        if ($technician == 1) { ?>
         <a class="nav-link collapsed " href="technician_index.php">
           <i class="bi bi-grid"></i>
           <span>Dashboard</span>
         </a>
       <?php } else { ?>
         <a class="nav-link collapsed " href="index.php">
           <i class="bi bi-grid"></i>
           <span>Dashboard</span>
         </a>
       <?php }
        ?>
     </li><!-- End Dashboard Nav -->

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
       <a class="nav-link collapsed" href="jobs.php">
         <i class="bi bi-briefcase-fill"></i>
         <span>Jobs</span>
       </a>
     </li><!-- End Jobs Page Nav -->

     <li class="nav-item">
       <a class="nav-link" href="faq.php">
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
       <a class="nav-link collapsed" href="logout.php">
         <i class="bi bi-box-arrow-in-right"></i>
         <span>Sign Out</span>
       </a>
     </li><!-- End Login Page Nav -->
   </ul>

 </aside><!-- End Sidebar-->
 <main id="main" class="main">

   <div class="pagetitle">
     <h1>Frequently Asked Questions</h1>
     <nav>
       <ol class="breadcrumb">
         <?php
          if ($technician == 1) { ?>
           <li class="breadcrumb-item"><a href="technician_index.php">Home</a></li>

         <?php } else { ?>
           <li class="breadcrumb-item"><a href="index.php">Home</a></li>
         <?php  }
          ?>
         <li class="breadcrumb-item active">F.A.Q's</li>
       </ol>
     </nav>
   </div><!-- End Page Title -->

   <section class="section faq">
     <div class="row">
       <div class="col-lg-6">

         <div class="card basic">
           <div class="card-body">
             <h5 class="card-title">Basic Questions</h5>

             <div>
               <h6>1. What is this platform for?</h6>
               <p>This platform is a marketplace where people can find and hire service providers for various services, and service providers can sell their services to potential customers..</p>
             </div>

             <div class="pt-2">
               <h6>2. What kind of services are available on this platform?</h6>
               <p>There is a wide range of services available on this platform, including but not limited to, home cleaning, handyman services, personal training, pet care, graphic design, writing, and web development.</p>
             </div>

             <div class="pt-2">
               <h6>3. How can I find a service provider on this platform?</h6>
               <p>You can search for service providers by entering specific keywords related to the service you require. The platform's search function will then display a list of available service providers matching your search criteria.</p>
             </div>

           </div>
         </div>

         <!-- F.A.Q Group 1 -->
         <div class="card">
           <div class="card-body">
             <h5 class="card-title">Becoming a Service Provider</h5>

             <div class="accordion accordion-flush" id="faq-group-1">



               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsOne-5" type="button" data-bs-toggle="collapse">
                     How do I become a service provider on this platform?
                   </button>
                 </h2>
                 <div id="faqsOne-5" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                   <div class="accordion-body">
                     Service providers can apply to join the platform by completing an online application form. The platform reviews each application and may require additional information or documentation before approving the service provider's account. Once approved, the service provider can create a profile, list their services, and start selling their services on the platform.
                   </div>
                 </div>
               </div>

               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsOne-6" type="button" data-bs-toggle="collapse">
                     Is there a fee for using this platform?
                   </button>
                 </h2>
                 <div id="faqsOne-6" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                   <div class="accordion-body">
                     The platform charges a service fee on each transaction. The fee varies depending on the type of service and the amount of the transaction.
                   </div>
                 </div>
               </div>

               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsOne-3" type="button" data-bs-toggle="collapse">
                     What are the payment options available on this platform?
                   </button>
                 </h2>
                 <div id="faqsOne-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                   <div class="accordion-body">
                     The platform offers several payment options, including credit card, PayPal, and bank transfer. Payment is made through the platform's secure payment system, and the funds are held in escrow until the service provider completes the work to the customer's satisfaction.
                   </div>
                 </div>
               </div>

               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsOne-7" type="button" data-bs-toggle="collapse">
                     What kind of support is available for customers and service providers?
                   </button>
                 </h2>
                 <div id="faqsOne-7" class="accordion-collapse collapse" data-bs-parent="#faq-group-1">
                   <div class="accordion-body">
                     The platform offers customer and service provider support through a variety of channels, including email and phone There is also an extensive knowledge base with answers to frequently asked questions and helpful articles to guide customers and service providers.
                   </div>
                 </div>
               </div>

             </div>

           </div>
         </div><!-- End F.A.Q Group 1 -->

       </div>

       <div class="col-lg-6">

         <!-- F.A.Q Group 2 -->
         <div class="card">
           <div class="card-body">
             <h5 class="card-title">Using this platform to find services</h5>

             <div class="accordion accordion-flush" id="faq-group-2">

               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsOne-1" type="button" data-bs-toggle="collapse">
                     How do I hire a service provider on this platform?
                   </button>
                 </h2>
                 <div id="faqsOne-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                   <div class="accordion-body">
                     Once you find a service provider that meets your needs, you can review their profile, which includes their rates, reviews, and ratings. You can then contact the service provider through their contact information provided to discuss your project and finalize the details of the work.
                   </div>
                 </div>
               </div>

               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsOne-2" type="button" data-bs-toggle="collapse">
                     How can I ensure the service provider is reliable and trustworthy?
                   </button>
                 </h2>
                 <div id="faqsOne-2" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                   <div class="accordion-body">
                     The platform allows customers to leave reviews and ratings of the service providers they have hired. This helps other customers gauge the quality of the service provider's work and professionalism.
                   </div>
                 </div>
               </div>

               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsOne-3" type="button" data-bs-toggle="collapse">
                     What are the payment options available on this platform?
                   </button>
                 </h2>
                 <div id="faqsOne-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                   <div class="accordion-body">
                     The platform offers several payment options, including credit card, PayPal, and bank transfer. Payment is made through the platform's secure payment system, and the funds are held in escrow until the service provider completes the work to the customer's satisfaction.
                   </div>
                 </div>
               </div>

               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsOne-7" type="button" data-bs-toggle="collapse">
                     What kind of support is available for customers and service providers?
                   </button>
                 </h2>
                 <div id="faqsOne-7" class="accordion-collapse collapse" data-bs-parent="#faq-group-2">
                   <div class="accordion-body">
                     The platform offers customer and service provider support through a variety of channels, including email and phone There is also an extensive knowledge base with answers to frequently asked questions and helpful articles to guide customers and service providers.
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div><!-- End F.A.Q Group 2 -->

         <!-- F.A.Q Group 3 -->
         <div class="card">
           <div class="card-body">
             <h5 class="card-title">Conflict Resolution</h5>

             <div class="accordion accordion-flush" id="faq-group-3">

               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsThree-1" type="button" data-bs-toggle="collapse">
                     What should I do if I have a conflict with a service provider or client on the platform?
                   </button>
                 </h2>
                 <div id="faqsThree-1" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                   <div class="accordion-body">
                     If you have a conflict with a service provider or client on the platform, the first step is to try and resolve the issue directly with the other party. If you are unable to resolve the issue directly, you can contact our support team for assistance.
                   </div>
                 </div>
               </div>

               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsThree-2" type="button" data-bs-toggle="collapse">
                     How can I contact the support team for help with a conflict?
                   </button>
                 </h2>
                 <div id="faqsThree-2" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                   <div class="accordion-body">
                     You can contact the support team by clicking on the "Help Desk" button located at the left side of each page on this platform. You can also email us directly at <a href="mailto:info@handyman.com">info@handyman.com</a> .
                   </div>
                 </div>
               </div>

               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsThree-3" type="button" data-bs-toggle="collapse">
                     What information should I provide when contacting the support team?
                   </button>
                 </h2>
                 <div id="faqsThree-3" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                   <div class="accordion-body">
                     When contacting the support team, please provide as much information as possible about the conflict, including the names of the parties involved, the nature of the conflict, and any relevant messages or documentation.
                   </div>
                 </div>
               </div>

               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsThree-4" type="button" data-bs-toggle="collapse">
                     What can I expect from the support team when I contact them about a conflict?
                   </button>
                 </h2>
                 <div id="faqsThree-4" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                   <div class="accordion-body">
                     The support team will review the information provided and work to resolve the conflict as quickly and fairly as possible. This may involve mediation between the parties or other actions, as determined by the specific circumstances of the conflict.
                   </div>
                 </div>
               </div>

               <div class="accordion-item">
                 <h2 class="accordion-header">
                   <button class="accordion-button collapsed" data-bs-target="#faqsThree-5" type="button" data-bs-toggle="collapse">
                     How long does it typically take to resolve a conflict?
                   </button>
                 </h2>
                 <div id="faqsThree-5" class="accordion-collapse collapse" data-bs-parent="#faq-group-3">
                   <div class="accordion-body">
                     The time it takes to resolve a conflict can vary depending on the specific circumstances of the conflict. However, our goal is to resolve conflicts as quickly as possible while ensuring a fair and equitable outcome for all parties involved.
                   </div>
                 </div>
               </div>

             </div>

           </div>
         </div><!-- End F.A.Q Group 3 -->

       </div>

     </div>
   </section>

 </main><!-- End #main -->
 <?php include 'inc/footer/footer.php' ?>