<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 03/06/2018
 * Time: 18:16
 */

namespace View;

/**
 * Class PageView
 * @package View
 */
class PageView
{
    /**
     *
     */
    public function adminHead(): void
    {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Admin</title>
        </head>
        <body>
        <a href="/admin/">Home</a>
        <?php
    }

    /**
     *
     */
    public function adminFoot(): void
    {
        ?>
        </body>
        </html>
        <?php
    }
    /**
     * @param array|null $data
     */
    public function index(?array $data): void
    {
        ?>
        <h1>List pages</h1>
        <a href="/admin/?a=page.add">Ajouter</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Slug</th>
                <th>Action</th>
            </tr>
            <?php if(is_null($data)):?>
                <tr>
                    <td colspan="3">No pages</td>
                </tr>
            <?php else:?>
                <?php foreach($data as $page):?>
                    <tr>
                        <td><?=$page['id'] ?? '&nbsp;'?></td>
                        <td><?=$page['slug'] ?? '&nbsp;'?></td>
                        <td><a href="?a=page.show&slug=<?=$page['slug']?>">show</a></td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>
        </table>
        <?php
    }

    /**
     * @param array|null $data
     */
    public function show(?array $data): void
    {
        ?>
        <h1><?=$data['title']?></h1>
        <a href="?a=page.edit&id=<?=$data['id']?>">Edit</a>
        <a href="?a=page.delete&id=<?=$data['id']?>">Delete</a>
        <p><strong>id</strong> : <?=$data['id']?></p>
        <p><strong>slug</strong> : <?=$data['slug']?></p>
        <p><strong>h1</strong> : <?=$data['h1']?></p>
        <p><strong>p</strong> : <?=nl2br($data['p'])?></p>
        <p><strong>span-class</strong> : <?=$data['span-class']?></p>
        <p><strong>span-text</strong> : <?=$data['span-text']?></p>
        <p><strong>img-alt</strong> : <?=$data['img-alt']?></p>
        <p><strong>img-src</strong> : <?=$data['img-src']?></p>
        <p><strong>nav-title</strong> : <?=$data['nav-title']?></p>
        <?php
    }

    /**
     *
     */
    public function add(): void
    {
        ?>
        <form action="?a=page.add" method="post">
            <input type="hidden" name="page[id]" value="">
            <label>slug</label><br><input type="text" name="page[slug]" value="" /><br>
            <label>title</label><br><input type="text" name="page[title]" value="" /><br>
            <label>h1</label><br><input type="text" name="page[h1]" value="" /><br>
            <label>p</label><br><textarea name="page[p]" id="" cols="30" rows="10"></textarea><br>
            <label>span-class</label><br><input type="text" name="page[span-class]" value="" /><br>
            <label>span-text</label><br><input type="text" name="page[span-text]" value="" /><br>
            <label>img-alt</label><br><input type="text" name="page[img-alt]" value="" /><br>
            <label>img-src</label><br><input type="text" name="page[img-src]" value="" /><br>
            <label>nav-title</label><br><input type="text" name="page[nav-title]" value="" /><br>
            <input type="submit" value="Ajouter">
        </form>
        <?php
    }

    public function edit(array $data): void
    {
        ?>
        <form action="?a=page.edit" method="post">
            <input type="hidden" name="page[id]" value="<?=$data['id']?>">
            <label>slug</label><br><input type="text" name="page[slug]" value="<?=$data['slug']?>" /><br>
            <label>title</label><br><input type="text" name="page[title]" value="<?=$data['title']?>" /><br>
            <label>h1</label><br><input type="text" name="page[h1]" value="<?=$data['h1']?>" /><br>
            <label>p</label><br><textarea name="page[p]" id="" cols="30" rows="10"><?=$data['p']?></textarea><br>
            <label>span-class</label><br><input type="text" name="page[span-class]" value="<?=$data['span-class']?>" /><br>
            <label>span-text</label><br><input type="text" name="page[span-text]" value="<?=$data['span-text']?>" /><br>
            <label>img-alt</label><br><input type="text" name="page[img-alt]" value="<?=$data['img-alt']?>" /><br>
            <label>img-src</label><br><input type="text" name="page[img-src]" value="<?=$data['img-src']?>" /><br>
            <label>nav-title</label><br><input type="text" name="page[nav-title]" value="<?=$data['nav-title']?>" /><br>
            <input type="submit" value="Modifier">
        </form>
        <?php
    }

    public function delete(array $data, int $id): void
    {
        ?>
        <h1>Do you reallllyyyyy wish to delete <u><?=$data['slug']?></u></h1>
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
            <input type="hidden" name="page[id]" value="<?=$id?>">
            <input type="submit" value="Delete">
            <input type="button" value="Cancel" onclick="history.back()">
        </form>
        <?php
    }

    public function checkIdGet(): int
    {
        if(!isset($_GET['id'])){
            throw new \Exception("Pleaaaaase gimme id for baby");
        }
        return (int) $_GET['id'];
    }

    public function checkIdPost(): int
    {
        $page = $_POST['page'];
        if(!isset($page['id'])){
            throw new \Exception("Pleaaaaase gimme id for baby");
        }
        return (int) $page['id'];
    }
}