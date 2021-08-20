<header class="header1">

<div class="container-menu-header">
<div class="topbar">
   <div class="topbar-social">

      <a href="{{$data['konfigurasi']->facebook}}" target="_blank" class="topbar-social-item fa fa-facebook"></a>
      <a href="{{$data['konfigurasi']->instagram}}" target="_blank" class="topbar-social-item fa fa-instagram"></a>
      <a href="https://www.youtube.com/channel/UCgiZeBV4xi8KdY9VmVKgUQw" target="_blank" class="topbar-social-item fa fa-youtube-play""></a>

   </div>

   <div class="topbar-child2">

      <span class="topbar-email mr-2">
         {{$data['konfigurasi']->email}}
      </span>

      <div class="topbar-language rs1-select2">

      <span class="topbar-email">
         {{$data['konfigurasi']->telepon}}
      </span>
      
      </div>
   </div>
   
</div>