{{-- /
  Title: Horizontal Text
  Description: text 
  Category: formatting
  Icon: admin-comments
  Keywords: text
  Mode: auto
  Align: center
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

<section class="c-direction-section">
    <div class="o-container" id="scroll-direction">
        <div class="c-direction-block_wrapper">
            <div class="c-direction-section_infos" data-scroll data-scroll-sticky data-scroll-target="#scroll-direction">
                <div class="c-direction-section_infos_inner" data-scroll>
                    <h3>
                        {{ $heading }}
                    </h3>
                    <div class="c-direction-sections_infos_text u-text">
                        <p>
                            {{ $subheading }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="c-direction-block" id="direction">
                <div class="c-direction-block_item -one">
                    <span class="c-direction-block_item_inner" data-scroll data-scroll-direction="horizontal"
                        data-scroll-speed="6" data-scroll-target="#direction">
                        {{ $textStrips['text_one'] }}
                    </span>
                </div>
                <div class="c-direction-block_item -two">
                    <span class="c-direction-block_item_inner" data-scroll data-scroll-direction="horizontal"
                        data-scroll-speed="-8" data-scroll-target="#direction">
                        {{ $textStrips['text_two'] }}
                    </span>
                </div>
                <div class="c-direction-block_item -three">
                    <span class="c-direction-block_item_inner" data-scroll data-scroll-direction="horizontal"
                        data-scroll-speed="9" data-scroll-target="#direction" data-scroll-delay="0.05">
                        {{ $textStrips['text_three'] }}
                    </span>
                </div>
                <div class="c-direction-block_item -four">
                    <span class="c-direction-block_item_inner" data-scroll data-scroll-direction="horizontal"
                        data-scroll-speed="15" data-scroll-target="#direction">
                        {{ $textStrips['text_four'] }}
                    </span>
                </div>
                <div class="c-direction-block_item -five">
                    <span class="c-direction-block_item_inner" data-scroll data-scroll-direction="horizontal"
                        data-scroll-speed="-20" data-scroll-target="#direction" data-scroll-delay="0.05">
                        {{ $textStrips['text_five'] }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
