$(document).ready(function(){
	$("#menushka, #pageup").on("click","a", function (event) {
		//�������� ����������� ��������� ������� �� ������
		event.preventDefault();

		//�������� ������������� ���� � �������� href
		var id  = $(this).attr('href'),

		//������ ������ �� ������ �������� �� ����� �� ������� ��������� �����
			top = $(id).offset().top;
		
		//��������� ������� �� ���������� - top �� 800 ��
		$('body,html').animate({scrollTop: top}, 800);
	});
});
