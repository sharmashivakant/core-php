<?='<?xml version="1.0" encoding="UTF-8"?>'?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= SITE_URL ?></loc> 
        <priority>1.0</priority>
    </url>
    <?php foreach($this->slugs as $slug) { ?>
    <url>
        <loc><?= $slug ?></loc>
        <priority>0.5</priority>
    </url>
    <?php } ?>
    <?php foreach($this->blogs as $blog) { ?>
    <url>
        <loc><?= SITE_URL.'blog/'.$blog->slug; ?></loc>
        <lastmod><?= date('Y-m-d', $blog->time); ?></lastmod>
        <priority>0.5</priority>
    </url>
    <?php } ?>
    <?php foreach($this->casestudies as $casestudy) { ?>
    <url>
        <loc><?= SITE_URL.'view-case-studies/'.$casestudy->slug; ?></loc>
        <lastmod><?= date('Y-m-d', $casestudy->time); ?></lastmod>
        <priority>0.5</priority>
    </url>
    <?php } ?>
    <?php foreach($this->list as $item) { ?>
    <url>
        <loc><?= SITE_URL.'job/'.$item->slug; ?></loc>
        <lastmod><?=  $item->lastmodifieddate; ?></lastmod>
        <priority>0.5</priority>
    </url>
    <?php } ?>
    <?php foreach($this->team as $teams) { ?>
    <url>
        <loc><?= SITE_URL.'team-details/'.$teams->slug; ?></loc>
        <priority>0.5</priority>
    </url>
    <?php } ?>
</urlset>