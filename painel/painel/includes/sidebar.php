<?php 
/* session_start(); */
function barralateral($pageName)
{
echo "
<!-- Sidebar -->
<ul style='background-color: #101728; background-image: linear-gradient(180deg,#101728 10%,#101728 100%)' class='navbar-nav bg-gradient-primary sidebar sidebar-dark accordion' id='accordionSidebar'>

    <!-- Sidebar - Brand -->
    <a class='sidebar-brand d-flex align-items-center justify-content-center' href='dashboard.php'>
        <div class='sidebar-brand-icon rotate-n-15'>
            <img src='../assets/images/Modern Geometric Finance Logo.png' width='75px'  height='75px' alt=''>
        </div>
        <div class='sidebar-brand-text mx-3'>Start Rain<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class='sidebar-divider my-0'>

    <!-- Nav Item - Dashboard -->
    ".($pageName == 'Dashboard' ? "<li class='nav-item active'>" : "<li class='nav-item'>")."
        <a class='nav-link' href='dashboard.php'>
        <i class='fas fa-fw fa-tachometer-alt'></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class='sidebar-divider'>

    <!-- Heading -->
    <div class='sidebar-heading'>
        Ferramentas
    </div>

    <!-- Nav Item - Sorteios -->
    ".($pageName == 'Sorteios' ? "<li class='nav-item active'>" : "<li class='nav-item'>")."
        <a class='nav-link' href='sorteio.php'>
            <i class='fas fa-fw fa-table'></i>
            <span>Sorteios</span></a>
    </li>

    <!-- Nav Item - Emails -->
    ".($pageName == 'Emails' ? "<li class='nav-item active'>" : "<li class='nav-item'>")."
        <a class='nav-link' href='email.php'>
        <i class='fa-regular fa-envelope'></i>
            <span>Emails</span>
        </a>
    </li>

    <!-- Nav Item - Dall-e -->
    ".($pageName == 'Dalle' ? "<li class='nav-item active'>" : "<li class='nav-item'>")."
        <a class='nav-link' href='startimagem.php'>
        <i class='fa-solid fa-robot'></i>
            <span>Gerador de Imagem</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class='text-center d-none d-md-inline'>
        <button class='rounded-circle border-0' id='sidebarToggle'></button>
    </div>

</ul>
<!-- End of Sidebar -->

";
}
?>