����: ��������� ������������ ��������� ��������� HTTP.


�������
x
��� ������������ ������ ����� ����� ���������� ����������� Response Builder, ������� ����������� � ���� ������, ������� ������ ���� ���������� �������. ��� ����� ������, ��� ������, ��������� ��������� � ���� ������.

� ������ ���������� ���������� ����������� ���������ResponseInterface�� ������Response, ������ ������ ���������� ������ ������, � ��� �� ����������� ������ ������� � �������� ���� ������ ������� � ������Application.

������ ������������� Response Builder:

<?php

$app->get('/', function () {
    return response(render('index'));
});

$app->post('/users', function ($meta, $params, $attributes) use ($users) {
    if (!isset($params['email'])) {
        return response('Expected email')->withStatus(400);
    }
    return response()->redirect('/');
});

src/App/Response.php

���������� ���������ResponseInterface�� ������Response.

src/App/Application.php

���������� ������ �������� ������ �������. ������� ���������� ������� � ��������� ������, ����� ��������� ��� ��������� � � ����� ���� ������, ���� ��� ����.









