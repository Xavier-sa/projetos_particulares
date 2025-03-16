from PySide6.QtGui import QImageReader

formatos_suportados = QImageReader.supportedImageFormats()
print([str(fmt, "utf-8") for fmt in formatos_suportados])
