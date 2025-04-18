<div class="column">
    <?php if($res): ?>

        <?php if(isset($res['mediadelivery'])): ?>

            <div class="iframe-container">
                <iframe width="100%" height="100%" src="<?= $res['mediadelivery'] ?>" frameborder="0" allow="autoplay; picture-in-picture" allowfullscreen></iframe>
            </div>

        <?php elseif(isset($res['youtube'])): ?>

            <div class="iframe-container">
                <iframe width="100%" height="100%" src="<?= $res['youtube'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>

        <?php elseif(isset($res['url'], $res['image'])): ?>

            <a href="<?= $res['url'] ?>" target="<?= $res['title'] ?>">
                <img class="stretch" src="<?= $res['image'] ?>" alt="<?= $res['title'] ?>"/>
            </a>

        <?php endif; ?>
        <div class="text-container">
            <div class="row">
                <img class="thumb" src="<?= PATH['images'] ?>icon-thumb.png"/>
                <h3><?= $res['title'] ?></h3>
                <?php if(isset($res['duration'])): ?>
                    
                    <div class="duration-display row">
                        <picture>
                            <source srcset="<?= PATH['images'] ?>icon-clock.svg" type="image/svg+xml">
                            <img src="<?= PATH['images'] ?>icon-clock.png" alt="Clock icon"/>
                        </picture>
                        <span><?= insertVars(__('vegan.video_duration'), $res['duration']) ?></span>
                    </div>

                <?php endif; ?>
            </div>
            <p><?= $res['description'] ?></p>
        </div>

    <?php endif; ?>
</div>