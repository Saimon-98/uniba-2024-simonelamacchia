//importiamo la libreria (React) per costruire l'interfaccia,
//quella per fare le richieste HTTP e il  CSS per stilizzarla.
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './css/App.css';

/**
 * Componente App che gestisce una lista di prodotti con funzionalità 
 * per aggiungere, modificare e eliminare prodotti.
 */
//Stato che memorizza lista prodotti, nuovo prodotto da aggiungere,
//e prodotto in fase di modifica
function App() {
    const [products, setProducts] = useState([]);
    const [newProduct, setNewProduct] = useState({});
    const [editedProduct, setEditedProduct] = useState(null);

  useEffect(() => {
    fetchProducts();
  }, []);
/**
 * Recupera la lista dei prodotti dal backend e aggiorna lo stato 'products'.
 */
  const fetchProducts = async () => {
    try {
      const response = await axios.get('/api/products'); // Assumendo che il backend fornisca le API per gestire le attività
      setProducts(response.data);
    } catch (error) {
      console.error('Errore nel recupero delle attività:', error);
    }
  };
/**
 * Aggiunge un nuovo prodotto inviando una richiesta POST al backend.
 * Aggiorna 'products' aggiungendo il nuovo prodotto, resetta
 * 'newProduct' dopo l'aggiunta.
 */
  const addProduct = async () => {
        try {
            const response = await axios.post('/api/products', { title: newProduct.name });
            setProducts([...products, response.data.data]);
            setNewProducts({});
    }catch (error) {
        console.error('Errore nell\'aggiunta del prodotto:', error);
    }
  };
/**
 * Modifica un prodotto esistente inviando una richiesta PUT al backend.
 * Aggiorna 'products' con dati del prodotto aggiornati, resetta
 * 'editedProduct' dopo la modifica.
 */
  const editProduct = async (id, updatedProduct) => {
    try {
        const response = await axios.put(`/api/products/${id}`, updatedProduct);
        const updatedProducts = products.map(product =>
          product.id === id ? response.data.data : product
        );
        setProducts(updatedProducts);
        setEditedProduct(null);
      } catch (error) {
        console.error('Errore nell\'aggiornamento del prodotto:', error);
      }
    };
/**
 * Elimina un prodotto inviando una richiesta DELETE al backend.
 * Aggiorna 'products' rimuovendo il prodotto eliminato.
 */
  const deleteProduct = async (id) => {
    try {
        await axios.delete(`/api/products/${id}`);
        const updatedProducts = products.filter(product => product.id !== id);
        setProducts(updatedProducts);
      } catch (error) {
        console.error('Errore nell\'eliminazione del prodotto:', error);
      }
  };
/**
 * Se ci sono dei prodotti, mostriamo una lista non ordinata.
 * Ogni prodotto avrà pulsanti per modificare ed eliminare.
 * Per la modifica mostreremo un campo e un pulsante per annullarla.
 * E campo per inserire il nome di un nuovo prodotto e un pulsante per aggiungerlo.
 */
  return (
    <div className="App">
      <h1>Lista Attività</h1>
      <div className="task-list">
        {products.length > 0 ? (
          <ul>
            {products.map(product => (
          <li key={product.id}>
            {editedProduct === product.id ? (
              <div>
                  <input
                    type="text"
                    value={product.name}
                    onChange={(e) => editProduct(product.id, { name: e.target.value })}
                  />
                  <button onClick={() => setEditedProduct(null)}>Annulla Prodotto</button>
                  </div>
                ) : (
                    <span>{product.title}</span>
                  )}
                  <button onClick={() => setEditedProduct(product.id)}>Modifica Prodotto</button>
                  <button onClick={() => deleteProduct(product.id)}>Elimina Prodotto</button>
                </li>
              ))}
            </ul>
          ) : (
            <p>Nessuna attività inserita</p>
          )}
        </div>
        <div className="add-task">
          <input
            type="text"
            value={newProduct.name || ''}
            onChange={(e) => setNewProduct({ name: e.target.value })}
            placeholder="Inserisci il nome del nuovo prodotto"
          />
          <button onClick={addProduct}>Aggiungi prodotto</button>
        </div>
      </div>
  );
}

export default App;