<?php
$attributes = get_query_var('attributes');

$args = [
    'post_type' => 'books',
    'meta_query' => [
            array(
                    'key'=>'price',
                'value'=>$attributes['price_above'],
                'type'=>'numeric',
                'compare'=> '>',
            )
    ],
];

if (isset($attributes['author'])) {
    $args['meta_query'][] =
        array(
            'key'=>'price',
            'value'=>$attributes['price_above'],
            'type'=>'numeric',
            'compare'=> '>',
        )
    ;
}

if (isset($attributes['price_above'])) {
    $args['meta_key'] = 'author';
    $args['meta_value'] = $attributes['author'];
}

if (isset($attributes['genres'])) {
    $args['tax_query'][] = [
        'taxonomy' => 'genres',
        'field' => 'slug',
        'terms' => [$attributes['genres']]
    ];
}

$query = new WP_Query($args);
?>

<?php if ($query->have_posts()) : ?>
    <?php while ($query->have_posts()): $query->the_post(); ?>
        <div class="card mb-3">
            <div class="card-body">
                <a href="<?php the_post_thumbnail_url('blog-small'); ?>">
                    <img src="<?php the_post_thumbnail_url('blog-small'); ?>" alt="<?php the_title(); ?>"
                         class="img-fluid">
                </a>
                <h3><?php the_title(); ?></h3>
                <?php the_field('author'); ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
