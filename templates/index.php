<!doctype html>
<html>
  <head>
    <title>No Ceremonies Are Necessary</title>
    <link rel="stylesheet" type="text/css" href="../../views/normalize.min.css" />
    <link rel="stylesheet" type="text/css" href="../../views/core.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
      main {
        width: 50%; margin-left: auto; margin-right: auto;
      }
      pre {
        max-height: 300px;
        overflow: scroll;
      }
      form p {
        display: flex;
        width: 100%;
      }
      form label {
        width: 20%;
        display: inline-block;
      }
      form input[type="text"], textarea {
        flex-grow: 1;
      }
      form input[type="submit"] {
        flex-grow: 1;
        padding: 0.4em;
      }
      form span label {
        width: auto;
      }
      textarea {
        height: 300px;
        border: 1px solid silver;
      }
    </style>
  </head>
  <body>
    <main>
      <h1>No Ceremonies Are Necessary</h1>

      <?if(isset($errors)):?>
        <div class="fail">
          <p><strong><?=$errors["errno"]?> error</strong></p>
          <?foreach($errors["errors"] as $key=>$error):?>
            <p><strong><?=$key?>: </strong><?=$error?></p>
          <?endforeach?>
        </div>
      <?endif?>

      <?if(isset($result)):?>
        <div>
          <p class="win">Post created.. <strong><a target="_blank" href="<?=$result->headers['location']?>"><?=$result->headers['location']?></a></strong></p>
        </div>
      <?endif?>

      <form method="post" role="form" id="ncan" class="align-center">

        <p>
          <label for="name">Title</label>
          <input type="text" name="name" id="name"<?=(isset($_POST['name'])) ? ' value="'.$_POST['name'].'"' : ''?> />
        </p>

        <p>
          <label for="content">Content</label>
          <textarea name="content" id="content"><?=(isset($_POST['content'])) ? $_POST['content'] : '<p>

</p>'?></textarea>
        </p>

        <p>
          <label for="tags">Tags</label>
          <input type="text" name="tags[string]" id="tags"<?=(isset($_POST['tags']['string'])) ? ' value="'.$_POST['tags']['string'].'"' : ''?> />
        </p>
        <?if(isset($tags)):?>
          <?if(!isset($_POST['tags']) || is_array($_POST['tags'])) { $_POST['tags'] = array(); }?>
          <p>
            <label></label>
            <span>
              <?foreach($tags as $label => $tag):?>
                <input type="checkbox" value="<?=$tag?>" name="tags[]" id="<?=$label?>"<?=(in_array($tag, $_POST['tags'])) ? " checked" : ""?> /><label for="<?=$label?>"><?=$label?></label>
              <?endforeach?>
            </span>
          </p>
        <?endif?>

        <p>
          <label>Published</label>
          <select name="year" id="year">
            <?for($i=date("Y");$i>=2018;$i--):?>
              <option value="<?=$i?>"<?=(isset($_POST['year']) && $i==$_POST['year']) ? " selected" : ""?>><?=$i?></option>
            <?endfor?>
          </select>
          <select name="month" id="month">
            <?for($i=1;$i<=12;$i++):?>
              <? $i = date("m", strtotime("2016-$i-01")); ?>
              <option value="<?=$i?>"
                <?=((isset($_POST['month']) && $_POST['month'] == $i) ? " selected" : (!isset($_POST['month']) && date("n") == $i)) ? " selected" : ""?>>
                <?=date("M", strtotime("2016-$i-01"))?>
              </option>
            <?endfor?>
          </select>
          <select name="day" id="day">
            <?for($i=1;$i<=31;$i++):?>
              <? $i = date("d", strtotime("2016-01-$i")); ?>
              <option value="<?=$i?>"
                <?=(((isset($_POST['day']) && $_POST['day'] == $i) ? " selected" : (!isset($_POST['day']) && date("j") == $i))) ? " selected" : ""?>>
                <?=$i?>
              </option>
            <?endfor?>
          </select>
          <input type="text" name="time" id="time" value="<?=(isset($_POST['time'])) ? $_POST['time'] : date("H:i:s")?>" size="8" />
          <input type="text" name="zone" id="zone" value="<?=(isset($_POST['zone'])) ? $_POST['zone'] : date("P")?>" size="5" />
          <button id="reload">&gt;&gt;</button>
        </p>
        <p>
          <input type="submit" name="record" value="Post" />
        </p>
        <hr/>
        <!-- temp -->
        <select name="endpoint_uri">
          <option value="https://rhiaro.co.uk/outgoing/">rhiaro.co.uk</option>
          <option value="http://localhost/outgoing/">localhost</option>
        </select>
        <input type="password" name="endpoint_key" />
        <!--/ temp -->
        <hr/>
      </form>

    </main>
    <footer class="w1of2 center">
      <p><a href="https://github.com/rhiaro/no-ceremonies-are-necessary">Code</a> | <a href="https://github.com/rhiaro/no-ceremonies-are-necessary/issues">Issues</a>
      <?if(isset($_SESSION['access_token'])):?>
        | <a href="https://apps.rhiaro.co.uk/no-ceremonies-are-necessary?token=<?=$_SESSION['access_token']?>">Quicklink</a>
      <?endif?>
      </p>
    </footer>

    <script src="js/reload-button.js"></script>
  </body>
</html>