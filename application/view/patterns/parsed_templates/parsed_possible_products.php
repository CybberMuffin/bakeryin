<?php for($i=0; $i < 3; $i++):
?>    <div class="posts-grid w3-posts-grid">
        <div class="posts-grid-left w3-posts-grid-left">
            <a href="product?id=<?=$dataArr[$i]->id?>"><img src="../public/images/<?=$dataArr[$i]->image?>" alt=" " class="img-responsive" /></a>
        </div>
        <div class="posts-grid-right w3-posts-grid-right">
            <h4><a href="product?id=<?=$dataArr[$i]->id?>"><?=$dataArr[$i]->name?></a></h4>
            <ul class="wthree_blog_events_list">
                <li><i class="fa fa-money" aria-hidden="true"></i><?=$dataArr[$i]->price?>$</li>
                <li><i class="fa fa-user" aria-hidden="true"></i><a href="product?id=<?=$dataArr[$i]->id?>">Admin</a></li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
<?php endfor;?>