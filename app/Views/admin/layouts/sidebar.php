<?php
$uri = service('uri')->getSegments();
$uri1 = $uri[1] ?? 'index';
$uri2 = $uri[2] ?? '';
$uri3 = $uri[3] ?? '';
?>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="/assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item <?= ($uri1 == 'index') ||  ($uri1 == 'warga') ? 'active' : '' ?> ">
                    <a href="/admin" class='sidebar-link'>
                        <i class="bi bi-laptop-fill"></i>
                        <span>Data Warga</span>
                    </a>
                </li>
                <li class="sidebar-item <?= ($uri1 == 'pengurus') ? 'active' : '' ?> ">
                    <a href="/admin/pengurus" class='sidebar-link'>
                        <i class="bi bi-file"></i>
                        <span>Data Pengurus</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/logout" class='sidebar-link'>
                        <i class="bi bi-arrow-bar-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>