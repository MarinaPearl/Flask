import os
import secrets

from flask import Flask, render_template, redirect, request, url_for
from flask_login import LoginManager, login_required, login_user, UserMixin
from flask_migrate import Migrate
from flask_sqlalchemy import SQLAlchemy
from flask_wtf import FlaskForm
from sqlalchemy.sql.functions import user
from wtforms import StringField, DateField, SubmitField, SelectField, PasswordField
from wtforms.validators import DataRequired, Length, EqualTo

secret_key = secrets.token_hex(16)
app = Flask(__name__)
app.secret_key = secret_key
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:Malina3114@127.0.0.1:3306/universityflask'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)
migrate = Migrate(app, db)
# db.init_app(app)

login_manager = LoginManager()
login_manager.login_view = 'auth.login'  # путь в Blueprint
login_manager.init_app(app)


@login_manager.user_loader
def load_user(user_id):
    return UserModel.query.get(int(user_id))


@app.route('/')
def start_page():  # put application's code here
    return render_template('start_page.html')


class UserForm(FlaskForm):
    name = StringField('Имя пользователя', validators=[DataRequired(), Length(min=2, max=50)])
    password = PasswordField('Пароль', validators=[DataRequired(), Length(min=6)])
    confirm_password = PasswordField('Подтвердите пароль', validators=[DataRequired(), EqualTo('password')])
    submit = SubmitField('Сохранить')


class UserModel(db.Model, UserMixin):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(1000))
    password = db.Column(db.String(100))

    def check_password(self, password):
        return self.password == password

    def is_active(self):
        return True


@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        name = request.form['name']
        password = request.form['password']
        try:
            user = UserModel.query.filter_by(name=name).first()
            print('aoa')
            if user.check_password(password):
                print('aoa1')
                login_user(user)
                print('aoa7')
                return redirect(url_for('start_page'))
            else:
                print('aoa2')
                return render_template('login.html', error='Неверное имя пользователя или пароль')
        except Exception as ex:
            print(ex)
            print('aoa4')
            return render_template('login.html', error='Неверное имя пользователя или пароль', form=UserForm())
    print('helll')
    return render_template('login.html', form=UserForm())


@app.route('/user/create', methods=['GET', 'POST'])
def create_user():
    form = UserForm()
    if request.method == 'POST':
        user = UserModel(name=form.name.data, password=form.password.data)
        db.session.add(user)
        db.session.commit()
        return redirect(url_for('start_page'))
    return render_template('create_user.html', form=form)


class UniversityModel(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    full_name = db.Column(db.String(250), nullable=False)
    short_name = db.Column(db.String(250), nullable=False)
    date_creation = db.Column(db.Date, nullable=False)

    def __repr__(self):
        return '<UniversityModel %r>' % self.id


class StudentModel(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    full_name = db.Column(db.String(250), nullable=False)
    date_bern = db.Column(db.Date, nullable=False)
    university_id = db.Column(db.Integer, db.ForeignKey('university_model.id'), nullable=True)
    university = db.relationship('UniversityModel', backref=db.backref('students'))
    date_admission = db.Column(db.Date, nullable=True)

    def __repr__(self):
        return f'<student_model {self.fio}>'


class UniversityForm(FlaskForm):
    full_name = StringField(label='Название университета', validators=[DataRequired()])
    short_name = StringField(label='Короткое название университета', validators=[DataRequired()])
    date_creation = DateField(label='Дата создания')
    submit = SubmitField("Submit")


class StudentForm(FlaskForm):
    full_name = StringField(label='ФИО', validators=[DataRequired()])
    date_bern = DateField(label='День Рождения', validators=[DataRequired()])
    university = SelectField(label='Университет', validators=[DataRequired()], coerce=int)
    date_admission = DateField(label='Год поступления', validators=[DataRequired()])
    submit = SubmitField("Submit")

    def __init__(self, *args, **kwargs):
        super(StudentForm, self).__init__(*args, **kwargs)
        self.university.choices = [(university.id, university.full_name) for university in UniversityModel.query.all()]


@app.route('/create_university/', methods=['GET', 'POST'])
@login_required
def create_university():
    form = UniversityForm()
    if request.method == 'POST':
        university = UniversityModel(
            full_name=form.full_name.data, short_name=form.short_name.data, date_creation=form.date_creation.data, )
        db.session.add(university)
        db.session.commit()
        return f'Created, {form.full_name.data}'
    return render_template('create_university.html', form=form)


@app.route('/create_student/', methods=['GET', 'POST'])
@login_required
def create_student():
    form = StudentForm()
    if request.method == 'POST':
        university = UniversityModel.query.get(form.university.data)
        student = StudentModel(
            full_name=form.full_name.data,
            date_bern=form.date_bern.data,
            university=university,
            date_admission=form.date_admission.data, )
        db.session.add(student)
        db.session.commit()
        return f'Created, {form.full_name.data}'
    return render_template('create_student.html', form=form)


@app.route('/student_array')
def student_array():
    students = StudentModel.query.all()
    return render_template('student_array.html', students=students)


@app.route('/delete_student/<int:student_id>', methods=['POST'])
def delete_student(student_id):
    student = StudentModel.query.get(student_id)
    db.session.delete(student)
    db.session.commit()
    return redirect('/student_array')


@app.route('/update_student/<int:student_id>', methods=['GET', 'POST'])
@login_required
def update_student(student_id):
    student = StudentModel.query.get(student_id)
    form = StudentForm(obj=student)
    universities = UniversityModel.query.all()  # Получаем список всех университетов
    form.university.choices = [(university.id, university.full_name) for university in universities]
    if request.method == 'POST':
        student.full_name = form.full_name.data
        student.date_bern = form.date_bern.data
        student.university_id = form.university.data
        student.date_admission = form.date_admission.data
        db.session.commit()
        return redirect('/student_array')

    return render_template('update_student.html', student=student, id=student_id, form=form)


@app.route('/university_array')
def university_array():
    universities = UniversityModel.query.all()
    return render_template('university_array.html', universities=universities)


@app.route('/delete_university/<int:university_id>', methods=['POST'])
def delete_university(university_id):
    university = UniversityModel.query.get(university_id)
    db.session.delete(university)
    db.session.commit()
    return redirect('/university_array')


@app.route('/update_university/<int:university_id>', methods=['GET', 'POST'])
@login_required
def update_university(university_id):
    university = UniversityModel.query.get(university_id)
    form = UniversityForm(obj=university)

    if request.method == 'POST':
        university.full_name = form.full_name.data
        university.short_name = form.short_name.data
        university.date_creation = form.date_creation.data
        db.session.commit()
        return redirect('/university_array')

    return render_template('update_university.html', university=university, id=university_id, form=form)


if __name__ == "__main__":
    app.run(debug=True)
