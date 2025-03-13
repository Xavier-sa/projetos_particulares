from PySide6.QtWidgets import (
    QMainWindow, QVBoxLayout, QLabel, QWidget, QPushButton, QLineEdit, QMessageBox
)
from PySide6.QtCore import Qt
from PySide6.QtGui import QDoubleValidator

import mysql.connector

STYLE = """
QWidget {
    background-color: #222222;
    color: #FFD700;
    font-family: 'Saiyan Sans', Arial, sans-serif;
}

QLabel {
    color: #F57C00;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
}

QLineEdit {
    background-color: #333333;
    color: #FFD700;
    border: 2px solid #F57C00;
    border-radius: 8px;
    padding: 10px;
    font-size: 18px;
}

QPushButton {
    background-color: #1976D2;
    color: #FFFFFF;
    border: 2px solid #F57C00;
    border-radius: 10px;
    font-size: 20px;
    font-weight: bold;
    padding: 12px;
    margin-top: 15px;
}

QPushButton:hover {
    background-color: #F57C00;
    color: #222222;
    border-color: #FFD700;
}

QPushButton:pressed {
    background-color: #D84315;
}

QLineEdit:focus {
    border: 2px solid #FFD700;
}

QMessageBox {
    background-color: #222222;
    color: #FFD700;
    font-size: 16px;
}
"""


class ProgressaoWindow(QMainWindow):
    def __init__(self, user_id, meta_id):
        super().__init__()
        self.user_id = user_id
        self.meta_id = meta_id

        self.setWindowTitle("Progresso da Meta")
        self.setGeometry(100, 100, 400, 300)

        # Widget central
        self.widget = QWidget()
        self.setCentralWidget(self.widget)

        # Layout principal
        layout = QVBoxLayout()

        # Campo para adicionar valor ao progresso
        self.label_valor = QLabel("Valor Adicionado:")
        self.input_valor = QLineEdit()
        self.input_valor.setValidator(QDoubleValidator())  # Validador para números decimais
        layout.addWidget(self.label_valor)
        layout.addWidget(self.input_valor)

        # Botão para salvar o progresso
        self.btn_salvar = QPushButton("Salvar Progresso")
        self.btn_salvar.clicked.connect(self.salvar_progresso)
        layout.addWidget(self.btn_salvar)

        # Definir o layout no widget
        self.widget.setLayout(layout)

    def connect_db(self):
        """Conecta ao banco de dados MySQL"""
        try:
            conn = mysql.connector.connect(
                host="localhost",
                user="root",
                password="",
                database="mau_mau"
            )
            return conn
        except mysql.connector.Error as err:
            QMessageBox.critical(self, "Erro", f"Erro ao conectar ao banco de dados: {err}")
            return None

    def salvar_progresso(self):
        """Salva o progresso da meta no banco de dados"""
        valor_adicionado = self.input_valor.text()
        if not valor_adicionado:
            QMessageBox.warning(self, "Erro", "O valor é obrigatório.")
            return

        conn = self.connect_db()
        if conn is None:
            return

        cursor = conn.cursor()

        try:
            # Atualizar o valor atual da meta
            cursor.execute('''
                UPDATE metas
                SET valor_atual = valor_atual + %s
                WHERE id = %s
            ''', (float(valor_adicionado), self.meta_id))

            # Registrar o progresso na tabela progresso
            cursor.execute('''
                INSERT INTO progresso (meta_id, valor_adicionado, data)
                VALUES (%s, %s, CURDATE())
            ''', (self.meta_id, float(valor_adicionado)))

            conn.commit()
            QMessageBox.information(self, "Sucesso", "Progresso salvo com sucesso!")
        except mysql.connector.Error as e:
            QMessageBox.critical(self, "Erro", f"Erro ao salvar o progresso: {e}")
        finally:
            cursor.close()
            conn.close()