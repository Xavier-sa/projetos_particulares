from PySide6.QtWidgets import (
    QMainWindow, QVBoxLayout, QLabel, QWidget, QPushButton, QTableWidget, QTableWidgetItem, QMessageBox
)
from PySide6.QtCore import Qt
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

class MetasWindow(QMainWindow):
    def __init__(self, user_id, username):
        super().__init__()
        self.user_id = user_id
        self.username = username

        self.setWindowTitle("Metas do Usuário")
        self.setGeometry(100, 100, 600, 400)

        # Widget central
        self.widget = QWidget()
        self.setCentralWidget(self.widget)

        # Layout principal
        layout = QVBoxLayout()

        # Exibir o nome do usuário
        self.label_nome = QLabel(f"Metas de {self.username}")
        layout.addWidget(self.label_nome)

        # Tabela para exibir as metas
        self.tabela_metas = QTableWidget()
        self.tabela_metas.setColumnCount(4)
        self.tabela_metas.setHorizontalHeaderLabels(["Meta", "Valor Total", "Valor Atual", "Status"])
        layout.addWidget(self.tabela_metas)

        # Botão para adicionar nova meta
        self.btn_adicionar_meta = QPushButton("Adicionar Meta")
        self.btn_adicionar_meta.clicked.connect(self.adicionar_meta)
        layout.addWidget(self.btn_adicionar_meta)

        # Carregar metas do banco de dados
        self.carregar_metas()

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

    def carregar_metas(self):
        """Carrega as metas do usuário do banco de dados"""
        conn = self.connect_db()
        if conn is None:
            return

        cursor = conn.cursor()
        cursor.execute('''
            SELECT nome_meta, valor_total, valor_atual, status
            FROM metas
            WHERE user_id = %s
        ''', (self.user_id,))

        metas = cursor.fetchall()

        # Preencher a tabela com as metas
        self.tabela_metas.setRowCount(len(metas))
        for row, meta in enumerate(metas):
            for col, value in enumerate(meta):
                self.tabela_metas.setItem(row, col, QTableWidgetItem(str(value)))

        cursor.close()
        conn.close()

    def adicionar_meta(self):
        """Abre uma janela para adicionar uma nova meta"""
        QMessageBox.information(self, "Adicionar Meta", "Funcionalidade em desenvolvimento!")