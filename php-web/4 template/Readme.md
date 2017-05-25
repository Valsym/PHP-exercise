����: ����������� ������� ��������� ������������ ���� �� �������������. �������� ���� ����������� ������������ � ������������� ��� �� ���������.


�������
x
� ����� ���������� ������� ����� � �����resources/views.

src/App/Template.php

���������� ��������render, ������� ��������� ���������� ���� �� ������� � ������ ����������, � ���������� ������� html.

src/App/Renderer.php

���������� ��������render�� ����������App\Renderer. ��� ��������� �� ���� ������������� ���� �� ������� � ���������. ��� ������� ������ ��������� ���������� ���� � ������� � �������� ��������render��������������App\Template.

������ �������������:

<?php

use function App\Renderer\render;

$app = new Application();

$app->get('/', function () {
    return render('index');
});

$app->get('/about', function () {
    return render('about', [
        'site' => 'hexlet.io',
        'subprojects' => ['battle.hexlet.io', 'map.hexlet.io']
    ]);
});

$app->run();






