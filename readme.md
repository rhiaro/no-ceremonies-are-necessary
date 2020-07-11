# No Ceremonies Are Necessary

Blog posts (notes and articles) app that posts to a server using the ActivityPub client-to-server protocol, ish.

Post body should be HTML.

## Run

```
docker run --rm --interactive --tty \
  --volume $PWD:/app \
  --volume ${COMPOSER_HOME:-$HOME/.composer}:/tmp \
  composer install
```

## Vocab

Posts objects with type `as:Note` or `as:Article`.

## Todo

* [ ] Fetch posts from endpoint to edit
* [ ] Save drafts in local storage