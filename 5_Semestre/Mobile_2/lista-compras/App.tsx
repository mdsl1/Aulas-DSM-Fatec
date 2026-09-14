import { StatusBar } from 'expo-status-bar';
import { useEffect, useState } from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { StyleSheet, Text, View, FlatList, Pressable, TextInput } from 'react-native';
import Checkbox from 'expo-checkbox';
import { withRunOnce } from 'expo/config-plugins';

type Item = {
    id: string,
    nome: string,
    qtde: number,
    isConcluido: boolean
}

const CHAVE_ITEMS = '@minha-lista:Items';

export default function App() {
    const [nome, setNome] = useState('');
    const [qtde, setQtde] = useState('');
    const [isConcluido, setIsConcluido] = useState(false);
    const [Items, setItems] = useState<Item[]>([]);

    const [carregouDados, setCarregouDados] = useState(false);
    const [erro, setErro] = useState('')

    useEffect(() => {
        async function carregarItems() {
        try {
            const dadosSalvos = await AsyncStorage.getItem(CHAVE_ITEMS);
            if(dadosSalvos)
            setItems(JSON.parse(dadosSalvos) as Item[]);
        } catch {
            setErro('Não foi possível carregar os itens salvos.')
        } finally {
            setCarregouDados(true);
        }
        }
        carregarItems();
    }, []);

    useEffect(() => {
        if (!carregouDados) {
            return;
        }

        async function salvarItems() {
            try {
                await AsyncStorage.setItem(
                CHAVE_ITEMS, JSON.stringify(Items));
                setErro('');
            } catch {
                setErro('Não foi possível salvar as alterações');
            }
        }
        salvarItems()
    }, [carregouDados, Items]);

    function adicionarItem() {
        setItems((ItemsAtuais) =>  [
            ...ItemsAtuais,
            {
                id: Date.now().toString(),
                nome: nome,
                qtde: Number(qtde),
                isConcluido: false
            }
        ]);
        setNome('');
        setQtde('');
    }

    return (
        <View style={styles.container}>
            <View style={styles.content}>

                <Text style={styles.h1}>Minha Lista de Compras</Text>

                <View style={styles.section}>
                    <Text style={styles.h2}>Adicionar item à lista:</Text>
                    <TextInput
                        style={styles.input}
                        placeholder='Nome do Item'
                        placeholderTextColor='#98a2b3'
                        value={nome}
                        onChangeText={setNome}
                    />
                    <TextInput
                        style={styles.input}
                        placeholder='Quantidade'
                        inputMode='numeric'
                        placeholderTextColor='#98a2b3'
                        value={qtde}
                        onChangeText={setQtde}
                    />
                    
                    <View style={styles.checkboxContainer}>
                        <Text style={styles.checkboxTitle}>Concluído?</Text>
                        <Checkbox
                            value={isConcluido}
                            onValueChange={setIsConcluido}
                            color={isConcluido ? '#20c4ff' : undefined}
                        />
                    </View>
                    <Pressable
                        onPress={adicionarItem}
                        style={styles.addButton}>
                        <Text style={styles.addButtonText}>Adicionar</Text>
                    </Pressable>
                </View>

                <View style={styles.section}>
                    <Text style={styles.h2}>Meus Itens</Text>
                    <FlatList
                        keyExtractor={(item) => item.id}
                        data={Items}
                        renderItem={({item}) => (
                            <View style={styles.cardContainer}>
                                <Text style={[styles.cardTitle, item.isConcluido ? styles.itemConcluido : null]}>{item.nome}</Text>
                                <Text style={[styles.cardQtde, item.isConcluido ? styles.itemConcluido : null]}>{item.qtde}</Text>
                                <Checkbox
                                    value={item.isConcluido}
                                    onValueChange={(valor) => {
                                        setItems((itemsAtuais) =>
                                            itemsAtuais.map((itemAtual) =>
                                                itemAtual.id === item.id
                                                    ? { ...itemAtual, isConcluido: valor }
                                                    : itemAtual
                                            )
                                        );
                                    }}
                                    color={item.isConcluido ? '#20c4ff' : undefined}
                                />
                            </View>
                        )} 
                    />
                </View>
            </View>

            <StatusBar style="auto" />
        </View>
    );
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: '#212121'
    },
    content: {
        flex: 1,
        paddingVertical: 110,
        paddingHorizontal: 30,
    },
    h1: {
        marginTop:6,
        color: '#26c5ff',
        fontSize: 30,
        fontWeight: '800',
        textAlign: "center"
    },
    h2: {
        marginBottom:10,
        color: '#4bcefe',
        fontSize: 20,
        fontWeight: '800',
        textAlign: "center"
    },
    section : {
        flexDirection: 'column',
        gap: 15,
        marginTop: 35,
        width: "100%",
        alignItems: "center"
    },
    checkboxContainer: {
        flexDirection: "row",
        gap: 10,
        justifyContent: "center",
        alignItems: "center",
        marginTop: 5,
        marginBottom: 10
    },
    checkboxTitle: {
        color: '#c7f7fe',
        fontSize: 17,
    },
    addButton : {
        minHeight: 52,
        justifyContent: 'center',
        backgroundColor: '#0094ca',
        width: "65%",
        borderRadius: 12
    },
    addButtonText: {
        color: "#fff",
        fontSize: 15,
        textAlign: "center",
        fontWeight: '700'
    },
    input: {
        flex: 1,
        minHeight: 52,
        width: "90%",
        paddingLeft: 20,
        borderWidth: 1,
        borderColor: '#d0d5dd',
        color: '#c7f7fe',
        borderRadius: 12,
        fontSize: 16
    },
    cardContainer: {
        flexDirection: "row",
        justifyContent: "space-between",
        gap: 15,
        backgroundColor: '#c9fffe',
        borderRadius: 12,
        width: "100%",
        paddingHorizontal: 30,
        paddingVertical: 10,
        marginVertical: 10
    },
    cardTitle: {
        fontSize: 16,
        fontWeight: '600',
        width: "60%"
    },
    cardQtde: {
        fontWeight: "500"
    },
    itemConcluido: {
        textDecorationLine: "line-through",
        color: "#525252"
    }
});
