����: ������������� � �������� ��������. ������� ������ ��� �������� ��������� � �� ���������.

�������
x
Application.php
x
������ ������ ��������� ����������� ��������� �App���� ������������ ������, ��������� �� ������ ��������http. ��������$app->get($path, $func).

src/App/Application.php

���������� ���������ApplicationInterface�� ������Application.

������:

<?php

$app = new \App\Application();

$app->get('/', function () {
    return 'hello, world!';
});

$app->post('/sign_in', function () {
    return 'sign in';
});

$app->run();

���������

$_SERVER['REQUEST_METHOD']�- �������� �������http������.





