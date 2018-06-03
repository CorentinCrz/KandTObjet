<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 03/06/2018
 * Time: 18:16
 */

namespace View;


class PageView
{
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
}