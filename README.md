# MiejsceSpotkan / MeetingPlace
Aplikacja pozawalająca zaznaczać na mapie ciekawe miejsca spotkań

Uruchomienie:
- W głównym katalogu projektu uruchomić komendę "composer install"
- Stworzyć plik ".env" w głównym katalogu projektu oraz go uzupełnić według ".env.example"  
- docker-compose build
- docker-compose up  
- Uruchomić komendę: "docker exec -it miejscespotkan-php_server-1 /bin/bash"
- następnie: "cd .."
- następnie: "php bin/console doctrine:migration:migrate" oraz wpisać "yes" i kliknąć enter
- Od teraz można korzystać z zasobów lub uruchomić "index.html" w katalogu "frontend"