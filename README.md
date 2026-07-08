# 우리들의 이야기

PHP + SQLite 기반의 경량 커뮤니티 웹사이트 시안입니다. Docker Compose로 로컬 실행과 종료가 가능합니다.

## 실행

```powershell
docker compose up -d --build
```

브라우저에서 `http://localhost:8090`으로 접속합니다.

포트를 바꾸고 싶다면 `.env`에 다음처럼 지정합니다.

```env
OUR_STORY_HTTP_BIND=127.0.0.1
OUR_STORY_HTTP_PORT=8091
```

## 종료

```powershell
docker compose down
```

SQLite 볼륨까지 완전히 지우려면 다음 명령을 사용합니다.

```powershell
docker compose down -v
```

## 구조

- `app/public/index.php`: 홈, 이야기, 소개, 멤버, 일정, 앨범, 운영 화면
- `app/public/styles.css`: 파스텔 라운지형 디자인 시안
- `app/public/assets/our-story-lounge.png`: 메인 비주얼 이미지
- `app/src/bootstrap.php`: SQLite 연결, 테이블 생성, 샘플 데이터
- `app/storage/data`: SQLite 데이터 저장 위치
- `docker`: nginx/php-fpm 설정

## 다음 작업 후보

- 실제 로그인/회원 권한 연결
- 게시판 글쓰기/수정/삭제 기능
- 사진 업로드와 앨범 관리
- 서버 Docker 배포 및 도메인 연결
