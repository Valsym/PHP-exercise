����: ����������� ��������� �������, ��� ��� �������������� � ��� ���������� � ���������.



�������
x
public/index.php

���������� �������/, ������� ����� ��������� ��������sort�� ��������� ����������$data�� ������������ � ���������� ����� ���������. ������sort:�field direction.�field�- �������� ����,�direction�- ����asc�����desc. ������:�id desc.

���������� ������ ������ ������������ �json�� ������� �������json_encode.

������:

<?php

$data = [
    ['id' => 4, 'age' => 15],
    ['id' => 3, 'age' => 28],
    ['id' => 8, 'age' => 3],
    ['id' => 1, 'age' => 23]
];

$actual = file_get_contents('http://localhost:8080?sort=age+desc');

$expected = [
    ['id' => 3, 'age' => 28],
    ['id' => 1, 'age' => 23],
    ['id' => 4, 'age' => 15],
    ['id' => 8, 'age' => 3]
];

json_encode($expected) == $actual







