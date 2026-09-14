import { StyleSheet, Text, View, ScrollView } from 'react-native';
import { StatusBar } from 'expo-status-bar';
import { ConceptCard } from './src/components/ConceptCard/index';
import { ConceptForm } from './src/components/ConceptForm/index';
import { useState } from 'react';

export default function App() {
    const [conceitos, setConceitos] = useState([
        { icon: '🔭', title: 'Componentes', description: 'Blocos que podem ser combinados e reutilizados' }
    ])

    function newConceptCard(icon: string, title: string, description: string ) {
        const newConceptCard = {
            icon,
            title,
            description
        }
        setConceitos((conceitosAtuais) => [...conceitosAtuais, newConceptCard])
    }

    return (
        <View style={styles.container}>
            <Text style={styles.titulo}>Olá Mundo!</Text>

            <ConceptForm add={newConceptCard} />

            <ScrollView style={styles.scrollview}>

                { conceitos.map((c, i) => (
                    <ConceptCard 
                        key={i}
                        icone={c.icon} 
                        titulo={c.title} 
                        descricao={c.description} 
                    />
                ))}

            </ScrollView>

            <Text style={styles.qtdeItens}>Itens: {conceitos.length}</Text>

            <StatusBar style='auto' />

        </View>
    );
}

const styles = StyleSheet.create({
    scrollview: {
        flex: 1,
        marginTop: 50
    },
    container: {
        flex: 1,
        backgroundColor: '#fff',
        alignItems: 'center',
        justifyContent: 'center',
        paddingVertical: 50
    },
    titulo: {
        fontSize: 40,
        fontWeight: 'black',
        marginBottom: 20
    },
    qtdeItens: {
        fontWeight: '500',
        marginTop: 20,
        fontSize: 15
    }
});