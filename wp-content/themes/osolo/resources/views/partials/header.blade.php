<header class="banner">

    <a class="logo link" href="{{ home_url('/') }}">
        <div>
            <span class="link-text"> Madeleine Enberg</span>
        </div>
    </a>

    <button type="button" class="menu-open" aria-label="Öppna menyn" aria-expanded="false" aria-controls="main-menu">
        <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
    </button>
</header>

{{-- inert redan i markupen: utan den går menylänkarna att tabba till
     medan menyn är stängd, även innan JS hunnit köra. --}}
<div class="menu-container" id="main-menu" aria-hidden="true" inert>
    <button type="button" class="menu-close" aria-label="Stäng menyn">
        <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
    </button>
    <nav class="menu-items" aria-label="Huvudmeny">
        <div class="menu-items-container">
            @foreach ($menu_items as $key => $menu_item)
                <span>
                    <a href="{{ $menu_item->url }}" class="menu-item">
                        <div class="menu-item-number">{{ '0' . $key + 1 }}</div>
                        <div class="menu-item-name">{{ $menu_item->title }}</div>
                        <div class="menu-item-sub">{{ $menu_item->description }}</div>
                        <div class="menu-item-icon">
                            <ion-icon name="arrow-up-outline" aria-hidden="true"></ion-icon>
                        </div>
                    </a>
                </span>
                <div class="line"></div>
            @endforeach
        </div>
    </nav>
</div>
