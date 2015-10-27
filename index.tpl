<!doctype html>
<html>
<head>
    <title>YouTube Search</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="clips_list">
    <? foreach ($view->data as $data): ?>
        <div class="singer">
            <? foreach ($data as $i => $clip): ?>
                <div class="clips">
                    <? if ($i == 0): ?>
                        <h3>
                            <?= $clip['singer_name'] ?>
                        </h3>
                    <? endif ?>
                    <?= $clip['clip_name'] ?> (просмотров <?= $clip['view_count'] ?>)
                    <? if ($i == 0): ?>
                        <a href="https://www.youtube.com/watch?v=<?= $clip['youtube_id'] ?>" target="_blank">Link on
                            YouTube</a>
                    <? endif ?>
                </div>
            <? endforeach;
            unset($i, $clip); ?>
            <hr>
        </div>
    <? endforeach;
    unset($data); ?>
</div>
</body>
</html>
