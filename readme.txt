1. Data User
	username : admin@gmail.com
	password : 123456
	level    : admin

	username : windarto@gmail.com
	password : 12345678
	level    : sales

2. PHP versi 8.1

3. Framework Laravel versi 10 

4. Deskripsi 
	a.	Sales mencari order , setelah mendapat order sales membuat data customer miliknya sendiri, sehingga setiap customer dan order akan melekat dengan nama salesnya yang berguna untuk melihat kinerja sales.
	b.	Admin menginput data-data orderan seperti nama inventory yang dirental oleh customer, jumlah inventory yang dirental, tanggal mulai rental, durasi rental, nama dan telp customer.
	c.      Kemudian sales bisa memberikan approval data orderan
	d.	Pada contoh ini setiap customer diberi limit jumlah inventory yang boleh dirental dalam satu order adalah sebanyak 5 unit.
	e.	Setiap data orderan diberi status untuk membantu admin dan sales dalam memantau inventory yang dirental customer. Secara default ada 2 status yaitu status Open untuk barang yang masih dirental dan status Kembali untuk barang yang sudah dikembalikan oleh customer. 
	f.	Orderan yang telah kembali inventorynya akan diinput ke tabel pengembalian inventory. Pengembalian ini juga diberi status yaitu status Tepat Waktu untuk barang yang dikembalikan tepat waktu oleh customer dan status Terlambat jika ada kelebihan waktu dari durasi yang sudah dicatat saat pembuatan order.    
	g.	Setelah pengemblian inventory oleh customer dan sudah diinputkan ke tabel penerimaan maka bisa dibuatkan Invoice oleh sales atau admin dimana invoice ini sudah lengkap dengan perhitungan jika ada perpanjangan waktu atau keterlambatan rental oleh customer.
	h.	Invoice yang sudah dibuatkan bisa dicetak atau dibuat ke dalam file PDF. 


