-- 1. OBTENER TODOS LOS EMPLEADOS DEL DEPARTAMENTO D003 QUE ESTEN TRABAJANDO ACTUALMENTE

	SELECT *
	FROM employees, dept_emp
	WHERE employees.emp_no = dept_emp.emp_no AND dept_emp.dept_no = "d003" AND dept_emp.to_date LIKE "9999%";

-- 2. OBTERNER LAS NOMINAS DE UN EMPLEADO ORDENADAS POR FECHA. (NOMBRE APELLIDO, NOMINA FROM_DATE TO_DATE)

	SELECT employees.first_name, employees.last_name, salaries.salary, salaries.from_date, salaries.to_date
	FROM employees, salaries
	WHERE employees.emp_no = salaries.emp_no AND employees.emp_no = 10010
	ORDER BY salaries.from_date DESC;

-- 3. OBTENER LOS 5 MAYORES SALARIOS DE PERSONAS DISTINTAS.

	SELECT employees.first_name, employees.last_name, MAX(salaries.salary) AS 'highest_salary'
	FROM employees, salaries
	WHERE employees.emp_no = salaries.emp_no
	GROUP BY employees.emp_no
	LIMIT 5;

-- 4. OBTENER LA LISTA DE TODOS LOS JEFES ACTUALES (NOMBRE, APELLIDO, NOMBRE DEPARTAMENTO)

	SELECT employees.first_name, employees.last_name, departmens.dept_name
	FROM employees, dept_manager, departments
	WHERE employees.emp_no = dept_manager.emp_no AND departments.dept_no = dept_manager.dept_no AND dept_emp.to_date LIKE "9999%";

-- 5. OBTENER TODOS LOS PUESTOS EN LOS QUE HA TRABAJADO EL EMPLEADO 10010 ORDENADO POR FECHA

	SELECT employees.emp_no, departments.dept_name, dept_emp.from_date
	FROM employees, dept_emp, departments
	WHERE employees.emp_no = dept_emp.emp_no AND departments.dept_no = dept_emp.dept_no AND employees.emp_no = 10010 ORDER BY dept_emp.from_date;

-- 6. OBTENER TODOS LOS EMPLEADOS INGENIEROS ACTUALES

	SELECT employees.emp_no, employees.first_name, employees.last_name
	FROM employees, titles
	WHERE employees.emp_no = titles.emp_no AND titles.title LIKE 'Engineer' AND titles.to_date LIKE '9999%';