# bandAPI
bandAPI

## how to use
```php
$bandAPI = BandAPI::loginBand($acces_token);
```
### 해당 계정에 가입된 밴드 가져오기
```php
$bandAPI->getBands();
```
### 밴드에 있는 글들 가져오기
```php
$bandAPI->getPosts($band_key, $local = 'ko_KR);
```
### 밴드에 글올리기
```php
$bandAPI->writePost($band_key, $content, $do_push = false);
// $content에 글 적기
```
### 밴드글 삭제
```php
$bandAPI->deletePost($band_key, $post_key);
```
### 글 댓글가져오기
```php
$bandAPI->getComments($band_key, $post_key, $sort = '+');
// + = 오래된 순 - = 최신순
```
### 댓글 적기
```php
$bandAPI->writeComment($band_key, $post_key, $body);
// $body에 내용 적기
```
### 댓글삭제
```php
$bandAPI->deleteComment($band_key, $post_key, $comment_key);
```
### 계정 밴드 권한 확인
```php
$bandAPI->getPermissions($band_key, $permission = 'posting,commenting,contents_deletion');
```

## 밴드 acces_token 얻는 곳
[바로가기](https://developers.band.us/)