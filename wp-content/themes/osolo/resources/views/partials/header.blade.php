<header class="banner">

    <a class="logo link" href="{{ home_url('/') }}">
        <div>
            <span class="link-text"> Madeleine Enberg</span>
        </div>
    </a>

    <div class="menu-open">
        <ion-icon name="menu-outline"></ion-icon>
    </div>
</header>

<div class="menu-container">
    <div class="menu-close">
        <ion-icon name="close-outline"></ion-icon>
    </div>
    <div class="menu-items">
        <div class="menu-items-container">
            @foreach ($menu_items as $key => $menu_item)
                <span>
                    <a href="{{ $menu_item->url }}" class="menu-item">
                        <div class="menu-item-number">{{ '0' . $key + 1 }}</div>
                        <div class="menu-item-name">{{ $menu_item->title }}</div>
                        <div class="menu-item-sub">{{ $menu_item->description }}</div>
                        <div class="menu-item-icon">
                            <ion-icon name="arrow-up-outline"></ion-icon>
                        </div>
                    </a>
                </span>
                <div class="line"></div>
            @endforeach
        </div>
    </div>
</div>
