# app.py
from flask import Flask, render_template, request, redirect, url_for, flash, send_from_directory
from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField
from wtforms.validators import DataRequired
import mysql.connector
from config import Config
import os
import shutil
from PIL import Image
import concurrent.futures

app = Flask(__name__)
app.config.from_object(Config)

# 数据库
def get_db_connection():
    return mysql.connector.connect(
        host='',
        user='',
        password='',
        database=''
    )

class TagImageForm(FlaskForm):
    filename = StringField('New Filename', validators=[DataRequired()])
    p_id = StringField('P站ID')
    artist_id = StringField('P站画师ID')
    tags = StringField('Tags (comma separated)', validators=[DataRequired()])
    theme = StringField('Theme (dark, light, fox, bj, favicon)', validators=[DataRequired()])
    source = StringField('Source')
    submit = SubmitField('Tag and Move Image')

@app.route('/')
def index():
    catch_dir = os.path.join(app.root_path, 'catch')
    images = [f for f in os.listdir(catch_dir) if os.path.isfile(os.path.join(catch_dir, f)) and f.lower().endswith(('.png', '.jpg', '.jpeg', '.gif'))]
    return render_template('index.html', images=images)

@app.route('/tag/<filename>', methods=['GET', 'POST'])
def tag_image(filename):
    form = TagImageForm()
    if form.validate_on_submit():
        new_filename = form.filename.data
        p_id = form.p_id.data
        artist_id = form.artist_id.data
        tags = form.tags.data.split(',')
        tags = [tag.strip() for tag in tags]
        theme = form.theme.data
        source = form.source.data

        if theme not in ['dark', 'light']:
            flash('Invalid theme. Please choose from dark, light', 'danger')
            return redirect(url_for('tag_image', filename=filename))

        try:
            conn = get_db_connection()
            cursor = conn.cursor()
            query = "INSERT INTO images (filename, p_id, artist_id, theme, source) VALUES (%s, %s, %s, %s, %s)"
            cursor.execute(query, (new_filename, p_id, artist_id, theme, source))
            image_id = cursor.lastrowid

            for tag in tags:
                if tag:
                    cursor.execute("INSERT IGNORE INTO tags (name) VALUES (%s)", (tag,))
                    cursor.execute("SELECT id FROM tags WHERE name = %s", (tag,))
                    tag_id = cursor.fetchone()[0]
                    cursor.execute("INSERT INTO image_tags (image_id, tag_id) VALUES (%s, %s)", (image_id, tag_id))

            conn.commit()

            # 重命名并移动图片
            catch_dir = os.path.join(app.root_path, 'catch')
            img_dir = os.path.join(app.root_path, 'img')
            current_path = os.path.join(catch_dir, filename)
            new_path = os.path.join(img_dir, new_filename)
            shutil.move(current_path, new_path)

            # 转换图片为WebP格式
            webp_filename = os.path.splitext(new_filename)[0] + '.webp'
            webp_path = os.path.join(img_dir, webp_filename)
            convert_image_to_webp(new_path, webp_path)

            # 更新数据库中的webp_path字段
            update_query = "UPDATE images SET webp_path = %s WHERE id = %s"
            cursor.execute(update_query, (webp_filename, image_id))
            conn.commit()

            flash('Image tagged, moved, and converted to WebP successfully!', 'success')
            return redirect(url_for('index'))

        except Exception as e:
            flash(f'Error: {str(e)}', 'danger')
            return redirect(url_for('tag_image', filename=filename))

    return render_template('tag_image.html', form=form, filename=filename)

@app.route('/delete/<filename>', methods=['GET'])
def delete_image(filename):
    try:
        catch_dir = os.path.join(app.root_path, 'catch')
        file_path = os.path.join(catch_dir, filename)
        if os.path.exists(file_path):
            os.remove(file_path)
            flash('Image deleted successfully!', 'success')
        else:
            flash('Image not found!', 'warning')
    except Exception as e:
        flash(f'Error: {str(e)}', 'danger')
    
    return redirect(url_for('index'))
@app.route('/catch/<path:filename>')
def serve_catch_file(filename):
    catch_dir = os.path.join(app.root_path, 'catch')
    return send_from_directory(catch_dir, filename)
@app.route('/img/<path:filename>')
def serve_img_file(filename):
    img_dir = os.path.join(app.root_path, 'img')
    return send_from_directory(img_dir, filename)

Image.MAX_IMAGE_PIXELS = 1000000000

def validate_folder_path(folder_path):
    clean_path = os.path.abspath(os.path.expanduser(folder_path))
    if not clean_path.startswith(os.path.abspath(os.getcwd())):
        raise ValueError("不安全的路径访问尝试。")
    return clean_path

def convert_image_to_webp(input_path, output_path):
    try:
        with Image.open(input_path) as img:
            img.save(output_path, "WEBP")
        print(f"Converted {os.path.basename(input_path)} to {os.path.basename(output_path)}")
    except Exception as e: 
        print(f"Cannot convert {os.path.basename(input_path)}: {e}")

if __name__ == '__main__':
    app.run(debug=True)