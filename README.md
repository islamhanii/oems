<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# POSTMAN

```
{
	"info": {
		"_postman_id": "249aebc4-cd20-4092-a940-110d6a6ceaf3",
		"name": "OEMS",
		"schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
	},
	"item": [
		{
			"name": "AUTH",
			"item": [
				{
					"name": "Registeration",
					"request": {
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "name",
									"value": "Adel Shakal",
									"type": "text"
								},
								{
									"key": "email",
									"value": "adel@shakal.com",
									"type": "text"
								},
								{
									"key": "password",
									"value": "123456789",
									"type": "text"
								},
								{
									"key": "role",
									"value": "1",
									"description": "student: 1, teacher: 2",
									"type": "default"
								},
								{
									"key": "image",
									"type": "file",
									"src": "/C:/Users/ELADEL/Desktop/237037950_4210424222366537_5361563623841532575_n.jpg"
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/register",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"register"
							]
						}
					},
					"response": []
				},
				{
					"name": "Login",
					"request": {
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "email",
									"value": "tito52@example.net",
									"type": "text"
								},
								{
									"key": "password",
									"value": "123456789",
									"type": "text"
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/login",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"login"
							]
						}
					},
					"response": []
				},
				{
					"name": "Logout",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|TC3spxQVzKTD9kUzLWbo1Bmv0SweNiRZujsNlKiu",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/logout",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"logout"
							]
						}
					},
					"response": []
				}
			]
		},
		{
			"name": "Courses",
			"item": [
				{
					"name": "My Courses",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "1|yViaBLEKvE1Bs3ZtqPPz5KI8mP7hgacvSz5xW4PV",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/myCourses/",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"myCourses",
								""
							]
						}
					},
					"response": []
				},
				{
					"name": "Show Course",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|B9KpvFihYpczkzCI55rl8aNMTPX6WpRzGKCAKiGG",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/courses/show/1",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"courses",
								"show",
								"1"
							]
						}
					},
					"response": []
				},
				{
					"name": "Search Courses",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "1|mzivF3UgUgLe9Y4MIWxeRWcJ08Y8mQ7ZA4db5n9D",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/courses/search/cls",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"courses",
								"search",
								"cls"
							]
						}
					},
					"response": []
				},
				{
					"name": "Create Course",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "name",
									"value": "",
									"type": "default"
								},
								{
									"key": "code",
									"value": "",
									"type": "default"
								},
								{
									"key": "description",
									"value": "",
									"type": "default"
								},
								{
									"key": "image",
									"type": "file",
									"src": []
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/courses/create",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"courses",
								"create"
							]
						}
					},
					"response": []
				},
				{
					"name": "Edit Course",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "name",
									"value": "",
									"type": "default"
								},
								{
									"key": "code",
									"value": "",
									"type": "default"
								},
								{
									"key": "description",
									"value": "",
									"type": "default"
								},
								{
									"key": "image",
									"type": "file",
									"src": []
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/courses/edit/1",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"courses",
								"edit",
								"1"
							]
						}
					},
					"response": []
				},
				{
					"name": "Manage Status",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|B9KpvFihYpczkzCI55rl8aNMTPX6WpRzGKCAKiGG",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "status",
									"value": "1",
									"description": "0 or 1",
									"type": "default"
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/courses/manage-status/1",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"courses",
								"manage-status",
								"1"
							]
						}
					},
					"response": []
				},
				{
					"name": "Join Course",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "1|yViaBLEKvE1Bs3ZtqPPz5KI8mP7hgacvSz5xW4PV",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "accesscode",
									"value": "678373",
									"description": "0 or 1",
									"type": "default"
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/courses/join/1",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"courses",
								"join",
								"1"
							]
						}
					},
					"response": []
				}
			]
		},
		{
			"name": "Exams",
			"item": [
				{
					"name": "Course's Exams",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "1|yViaBLEKvE1Bs3ZtqPPz5KI8mP7hgacvSz5xW4PV",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/courses/1/exams",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"courses",
								"1",
								"exams"
							]
						}
					},
					"response": []
				},
				{
					"name": "Show Exam",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "1|yViaBLEKvE1Bs3ZtqPPz5KI8mP7hgacvSz5xW4PV",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/exams/show/1",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"exams",
								"show",
								"1"
							]
						}
					},
					"response": []
				},
				{
					"name": "Exam's Questions",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "1|yViaBLEKvE1Bs3ZtqPPz5KI8mP7hgacvSz5xW4PV",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/exams/1/questions",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"exams",
								"1",
								"questions"
							]
						}
					},
					"response": []
				},
				{
					"name": "Create Exam",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|B9KpvFihYpczkzCI55rl8aNMTPX6WpRzGKCAKiGG",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "name",
									"value": "exam 1",
									"type": "default"
								},
								{
									"key": "description",
									"value": "haaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
									"type": "default"
								},
								{
									"key": "duration_minutes",
									"value": "255",
									"type": "default"
								},
								{
									"key": "totle",
									"value": "255",
									"type": "default"
								},
								{
									"key": "active_minutes",
									"value": "255",
									"type": "default"
								},
								{
									"key": "started_at",
									"value": "2022-06-22 21:52:00",
									"type": "default"
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/courses/1/exams/create",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"courses",
								"1",
								"exams",
								"create"
							]
						}
					},
					"response": []
				},
				{
					"name": "Edit Exam",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "1|zp8NNtOmLY1PYOwnUO833ByQn2fEsR14i6AfWkRB",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "name",
									"value": "exam 1",
									"type": "default"
								},
								{
									"key": "description",
									"value": "sasddddddasssssssssssssssaas",
									"type": "default"
								},
								{
									"key": "duration_minutes",
									"value": "30",
									"type": "default"
								},
								{
									"key": "totle",
									"value": "100",
									"type": "default"
								},
								{
									"key": "active_minutes",
									"value": "15",
									"type": "default"
								},
								{
									"key": "started_at",
									"value": "2022-06-22 01:03:00",
									"type": "default"
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/exams/edit/1",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"exams",
								"edit",
								"1"
							]
						}
					},
					"response": []
				},
				{
					"name": "Add Question",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|B9KpvFihYpczkzCI55rl8aNMTPX6WpRzGKCAKiGG",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": []
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/exams/1/add-question/200",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"exams",
								"1",
								"add-question",
								"200"
							]
						}
					},
					"response": []
				},
				{
					"name": "Add Bank",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|B9KpvFihYpczkzCI55rl8aNMTPX6WpRzGKCAKiGG",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "number_of_questions",
									"value": "8",
									"type": "default"
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/exams/1/add-bank/2",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"exams",
								"1",
								"add-bank",
								"2"
							]
						}
					},
					"response": []
				},
				{
					"name": "Start Exam",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "1|yViaBLEKvE1Bs3ZtqPPz5KI8mP7hgacvSz5xW4PV",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": []
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/exams/1/start",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"exams",
								"1",
								"start"
							]
						}
					},
					"response": []
				},
				{
					"name": "Finish Exam",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "1|yViaBLEKvE1Bs3ZtqPPz5KI8mP7hgacvSz5xW4PV",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": []
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/exams/1/finish",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"exams",
								"1",
								"finish"
							]
						}
					},
					"response": []
				}
			]
		},
		{
			"name": "Banks",
			"item": [
				{
					"name": "Course's Banks",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/courses/1/banks",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"courses",
								"1",
								"banks"
							]
						}
					},
					"response": []
				},
				{
					"name": "Show Bank",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/banks/show/1",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"banks",
								"show",
								"1"
							]
						}
					},
					"response": []
				},
				{
					"name": "Create Bank",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "name",
									"value": "",
									"type": "default"
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/courses/1/banks/create",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"courses",
								"1",
								"banks",
								"create"
							]
						}
					},
					"response": []
				},
				{
					"name": "Edit Bank",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "name",
									"value": "",
									"type": "default"
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/banks/edit/1",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"banks",
								"edit",
								"1"
							]
						}
					},
					"response": []
				}
			]
		},
		{
			"name": "Questions",
			"item": [
				{
					"name": "Bank's Questions",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/banks/1/questions",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"banks",
								"1",
								"questions"
							]
						}
					},
					"response": []
				},
				{
					"name": "Show Question",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/questions/show/5",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"questions",
								"show",
								"5"
							]
						}
					},
					"response": []
				},
				{
					"name": "Delete Question's Image",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/images/delete/5",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"images",
								"delete",
								"5"
							]
						}
					},
					"response": []
				},
				{
					"name": "Create Question",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "header",
									"value": "",
									"type": "default"
								},
								{
									"key": "diffculty",
									"value": "",
									"description": "easy - normal - hard",
									"type": "default"
								},
								{
									"key": "image[]",
									"description": "max: 5 images",
									"type": "file",
									"src": []
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/banks/1/questions/create",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"banks",
								"1",
								"questions",
								"create"
							]
						}
					},
					"response": []
				},
				{
					"name": "Edit Quesiton",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "header",
									"value": "",
									"type": "default"
								},
								{
									"key": "diffculty",
									"value": "",
									"description": "easy - normal - hard",
									"type": "default"
								},
								{
									"key": "image[]",
									"description": "max: 5 images",
									"type": "file",
									"src": []
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/questions/edit/5",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"questions",
								"edit",
								"5"
							]
						}
					},
					"response": []
				},
				{
					"name": "Answer Question",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "1|yViaBLEKvE1Bs3ZtqPPz5KI8mP7hgacvSz5xW4PV",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "answer",
									"value": "119",
									"type": "default"
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/exams/1/questions/30/answer",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"exams",
								"1",
								"questions",
								"30",
								"answer"
							]
						}
					},
					"response": []
				}
			]
		},
		{
			"name": "Choices",
			"item": [
				{
					"name": "Show Choice",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [],
						"url": {
							"raw": "http://127.0.0.1:8000/api/choices/show/5",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"choices",
								"show",
								"5"
							]
						}
					},
					"response": []
				},
				{
					"name": "Create Choice",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "option",
									"value": "",
									"type": "default"
								},
								{
									"key": "right_answer",
									"value": "",
									"description": "1 - 0 (true - false)",
									"type": "default"
								},
								{
									"key": "image",
									"type": "file",
									"src": []
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/questions/1/choices/create",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"questions",
								"1",
								"choices",
								"create"
							]
						}
					},
					"response": []
				},
				{
					"name": "Edit Choice",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "2|XTcajVqbI1luvgEav8jWjc2Q9H43FyDPVRsPdlKk",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{
									"key": "option",
									"value": "",
									"type": "default"
								},
								{
									"key": "right_answer",
									"value": "",
									"description": "1 - 0 (true - false)",
									"type": "default"
								},
								{
									"key": "image",
									"type": "file",
									"src": []
								}
							]
						},
						"url": {
							"raw": "http://127.0.0.1:8000/api/questions/1/choices/create",
							"protocol": "http",
							"host": [
								"127",
								"0",
								"0",
								"1"
							],
							"port": "8000",
							"path": [
								"api",
								"questions",
								"1",
								"choices",
								"create"
							]
						}
					},
					"response": []
				}
			]
		}
	]
}
```